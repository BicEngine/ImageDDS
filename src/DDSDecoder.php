<?php

declare(strict_types=1);

namespace Bic\Image\DDS;

use Bic\Binary\Endianness;
use Bic\Binary\StreamInterface;
use Bic\Binary\Type;
use Bic\Binary\TypedStream;
use Bic\Image\DDS\Exception\DDSException;
use Bic\Image\Compression;
use Bic\Image\CompressionInterface;
use Bic\Image\DDS\Metadata\DDSHeaderDXT10;
use Bic\Image\DDS\Metadata\DDSFourCC;
use Bic\Image\DDS\Metadata\DDSHeader;
use Bic\Image\DDS\Metadata\DDSPixelFormat;
use Bic\Image\DDS\Metadata\DXT10\AlphaMode;
use Bic\Image\DDS\Metadata\DXT10\DXGIFormat;
use Bic\Image\DDS\Metadata\DXT10\ResourceDimension;
use Bic\Image\DDS\Metadata\DXT10\ResourceMiscFlag;
use Bic\Image\DDS\Metadata\PixelFormat\Flag;
use Bic\Image\DecoderInterface;
use Bic\Image\Image;
use Bic\Image\ImageInterface;
use Bic\Image\PixelFormat;

final class DDSDecoder implements DecoderInterface
{
    /**
     * A DWORD (magic number) containing the four character code
     * value "DDS " (0x20534444).
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/direct3ddds/dx-graphics-dds-pguide#dds-file-layout
     * @var non-empty-string
     */
    public const HEADER_MAGICK = 'DDS ';

    /**
     * {@inheritDoc}
     */
    public function decode(StreamInterface $stream): ?iterable
    {
        if ($stream->read(4) === self::HEADER_MAGICK) {
            return $this->read($stream);
        }

        return null;
    }

    /**
     * @param StreamInterface $stream
     *
     * @return iterable<ImageInterface>
     * @throws DDSException
     *
     * @psalm-suppress all
     */
    private function read(StreamInterface $stream): iterable
    {
        $stream = new TypedStream($stream, Endianness::LITTLE);

        // Read DDS Header
        $header = self::readDDSHeader($stream);

        // Read second DDS (DXT10) header
        $dxt10h = self::findDXT10Header($stream, $header);

        $format = self::getDXGIFormat($header, $dxt10h);

        $blockSize = $format->getBytesPerBlock();
        $isCompressed = $format->isCompressedBlock();
        $metadata = new DDSMetadata($header, $dxt10h);
        $pixelFormat = self::getPixelFormat($header, $dxt10h);
        $compression = self::getCompression($header, $dxt10h);

        [$width, $height] = [$header->width, $header->height];
        for ($level = 0; $level < $header->mipMapCount && ($width || $height); ++$level) {
            [$width, $height] = [\max($width, 1), \max($height, 1)];

            /** @psalm-var positive-int $size */
            $size = $isCompressed
                ? (int)((($width + 3) >> 2) * (($height + 3) >> 2) * $blockSize)
                : (int)($width * $height * $blockSize);

            yield new Image(
                format: $pixelFormat,
                width: $width,
                height: $height,
                contents: $stream->read($size),
                compression: $compression,
                metadata: $metadata,
            );

            $width >>= 1;
            $height >>= 1;
        }
    }

    /**
     * @param DDSHeader $header
     * @param DDSHeaderDXT10|null $dxt10
     *
     * @return CompressionInterface
     * @throws DDSException
     *
     * @psalm-suppress PossiblyNullPropertyFetch DXT10 header already defined for FourCC = DX10
     */
    private static function getCompression(DDSHeader $header, ?DDSHeaderDXT10 $dxt10): CompressionInterface
    {
        return match ($header->format->fourCC) {
            DDSFourCC::DXT1 => DDSCompression::BC1,
            DDSFourCC::DXT2, DDSFourCC::DXT3 => DDSCompression::BC2,
            DDSFourCC::DXT4, DDSFourCC::DXT5 => DDSCompression::BC3,
            DDSFourCC::ATI1, DDSFourCC::BC4U, DDSFourCC::BC4S => DDSCompression::BC4,
            DDSFourCC::ATI2, DDSFourCC::BC5U, DDSFourCC::BC5S => DDSCompression::BC5,
            DDSFourCC::DX10 => match ($dxt10->dxgiFormat) {
                DXGIFormat::DXGI_FORMAT_BC1_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC1_UNORM,
                DXGIFormat::DXGI_FORMAT_BC1_UNORM_SRGB => DDSCompression::BC1,
                DXGIFormat::DXGI_FORMAT_BC2_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC2_UNORM,
                DXGIFormat::DXGI_FORMAT_BC2_UNORM_SRGB => DDSCompression::BC2,
                DXGIFormat::DXGI_FORMAT_BC3_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC3_UNORM,
                DXGIFormat::DXGI_FORMAT_BC3_UNORM_SRGB => DDSCompression::BC3,
                DXGIFormat::DXGI_FORMAT_BC4_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC4_UNORM,
                DXGIFormat::DXGI_FORMAT_BC4_SNORM => DDSCompression::BC4,
                DXGIFormat::DXGI_FORMAT_BC5_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC5_UNORM,
                DXGIFormat::DXGI_FORMAT_BC5_SNORM => DDSCompression::BC5,
                DXGIFormat::DXGI_FORMAT_BC6H_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC6H_UF16,
                DXGIFormat::DXGI_FORMAT_BC6H_SF16 => DDSCompression::BC6,
                DXGIFormat::DXGI_FORMAT_BC7_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC7_UNORM,
                DXGIFormat::DXGI_FORMAT_BC7_UNORM_SRGB => DDSCompression::BC7,
                default => Compression::NONE,
            },
            default => throw new DDSException(
                \sprintf('%s image format not supported', $header->format->fourCC->name)
            ),
        };
    }

    /**
     * @param DDSHeader $header
     * @param DDSHeaderDXT10|null $dxt10
     *
     * @return PixelFormat
     * @throws DDSException
     *
     * @psalm-suppress PossiblyNullPropertyFetch DXT10 header already defined for FourCC = DX10
     * @psalm-suppress PossiblyNullArgument      Same
     */
    private static function getPixelFormat(DDSHeader $header, ?DDSHeaderDXT10 $dxt10): PixelFormat
    {
        return match ($header->format->fourCC) {
            // BC1
            DDSFourCC::DXT1 => PixelFormat::R8G8B8,
            // BC2
            DDSFourCC::DXT2, DDSFourCC::DXT3,
            // BC3
            DDSFourCC::DXT4, DDSFourCC::DXT5 => PixelFormat::R8G8B8A8,
            // Other
            DDSFourCC::DX10 => match ($dxt10->dxgiFormat) {
                DXGIFormat::DXGI_FORMAT_B8G8R8A8_UNORM,
                DXGIFormat::DXGI_FORMAT_B8G8R8A8_UNORM_SRGB,
                DXGIFormat::DXGI_FORMAT_B8G8R8A8_TYPELESS,
                    => PixelFormat::B8G8R8A8,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_TYPELESS,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM_SRGB,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_SNORM,
                DXGIFormat::DXGI_FORMAT_R8G8B8A8_SINT,
                // Compressed RGBA
                DXGIFormat::DXGI_FORMAT_BC2_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC2_UNORM,
                DXGIFormat::DXGI_FORMAT_BC2_UNORM_SRGB,
                DXGIFormat::DXGI_FORMAT_BC3_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC3_UNORM,
                DXGIFormat::DXGI_FORMAT_BC3_UNORM_SRGB,
                DXGIFormat::DXGI_FORMAT_BC7_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC7_UNORM,
                DXGIFormat::DXGI_FORMAT_BC7_UNORM_SRGB,
                    => PixelFormat::R8G8B8A8,
                // Compressed RGB
                DXGIFormat::DXGI_FORMAT_BC1_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC1_UNORM,
                DXGIFormat::DXGI_FORMAT_BC1_UNORM_SRGB,
                DXGIFormat::DXGI_FORMAT_BC6H_TYPELESS,
                DXGIFormat::DXGI_FORMAT_BC6H_UF16,
                DXGIFormat::DXGI_FORMAT_BC6H_SF16,
                    => PixelFormat::R8G8B8,
                default => throw new DDSException(
                    \sprintf('%s pixel compression format not supported', $dxt10->dxgiFormat->name)
                ),
            },
            default => throw new DDSException(
                \sprintf('%s image format not supported', $header->format->fourCC->name)
            ),
        };
    }

    private static function findDXT10Header(TypedStream $stream, DDSHeader $header): ?DDSHeaderDXT10
    {
        if ($header->format->fourCC === DDSFourCC::DX10) {
            return self::readDXT10Header($stream);
        }

        return null;
    }

    /**
     * @param DDSHeader $header
     * @param DDSHeaderDXT10|null $dxt10
     *
     * @return DXGIFormat
     */
    private static function getDXGIFormat(DDSHeader $header, ?DDSHeaderDXT10 $dxt10): DXGIFormat
    {
        return $dxt10?->dxgiFormat ?? DXGIFormat::fromPixelFormat($header->format);
    }

    /**
     * @param TypedStream $stream
     *
     * @return DDSHeader
     *
     * @psalm-suppress InvalidScalarArgument
     */
    public static function readDDSHeader(TypedStream $stream): DDSHeader
    {
        return new DDSHeader(
            size: $stream->uint32(),
            flags: self::uint32flags($stream, DDSHeader\Flag::class),
            height: $stream->uint32(),
            width: $stream->uint32(),
            pitchOrLinearSize: $stream->uint32(),
            depth: $stream->uint32(),
            mipMapCount: $stream->uint32(),
            reserved1: $stream->array(11, Type::UINT32),
            format: self::readPixelFormat($stream),
            caps: self::uint32flags($stream, DDSHeader\Capability::class),
            caps2: self::uint32flags($stream, DDSHeader\Capability2::class),
            reserved2: $stream->array(3, Type::UINT32),
        );
    }

    /**
     * @param TypedStream $stream
     *
     * @return DDSHeaderDXT10
     */
    private static function readDXT10Header(TypedStream $stream): DDSHeaderDXT10
    {
        return new DDSHeaderDXT10(
            dxgiFormat: DXGIFormat::from($stream->uint32()),
            resourceDimension: ResourceDimension::from($stream->uint32()),
            miscFlag: ResourceMiscFlag::from($stream->uint32()),
            arraySize: $stream->uint32(),
            miscFlags2: AlphaMode::from($stream->uint32()),
        );
    }

    /**
     * @param TypedStream $stream
     *
     * @return DDSPixelFormat
     */
    private static function readPixelFormat(TypedStream $stream): DDSPixelFormat
    {
        return new DDSPixelFormat(
            size: $stream->uint32(),
            flags: self::uint32flags($stream, Flag::class),
            fourCC: DDSFourCC::from($stream->read(4)),
            rgbBitCount: $stream->uint32(),
            rBitMask: $stream->uint32(),
            gBitMask: $stream->uint32(),
            bBitMask: $stream->uint32(),
            aBitMask: $stream->uint32()
        );
    }

    /**
     * @template TEnum of \BackedEnum
     *
     * @param TypedStream $stream
     * @param class-string<TEnum> $enum
     *
     * @return list<TEnum>
     *
     * @psalm-suppress all
     */
    private static function uint32flags(TypedStream $stream, string $enum): array
    {
        $result = [];
        $actual = $stream->uint32();

        /** @var \BackedEnum $case */
        foreach ($enum::cases() as $case) {
            if (($actual & $case->value) === $case->value) {
                $result[] = $case;
            }
        }

        return $result;
    }
}
