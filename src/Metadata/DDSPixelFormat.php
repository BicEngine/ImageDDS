<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata;

use Bic\Image\DDS\Metadata\PixelFormat\Flag;

/**
 * Surface pixel format.
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/direct3ddds/dds-pixelformat
 */
final class DDSPixelFormat
{
    /**
     * @param int $size Structure size; set to 32 (bytes).
     * @param list<Flag> $flags Values which indicate what type of data is in the surface.
     * @param DDSFourCC $fourCC Four-character codes for specifying compressed or custom formats. Possible values
     *                          include: DXT1, DXT2, DXT3, DXT4, or DXT5. A FourCC of DX10 indicates the prescense of
     *                          the {@see DDSHeaderDXT10} extended header, and the {@see DDSHeaderDXT10::$dxgiFormat}
     *                          member of that structure indicates the true format. When using a four-character code,
     *                          {@see DDSPixelFormat::$flags} must include {@see Flag::FOURCC}.
     * @param int $rgbBitCount Number of bits in an RGB (possibly including alpha) format. Valid when
     *                         {@see DDSPixelFormat::$flags} includes {@see Flag::RGB}, {@see Flag::LUMINANCE},
     *                         or {@see Flag::YUV}.
     * @param int $rBitMask Red (or luminance or Y) mask for reading color data. For instance, given the A8R8G8B8
     *                      format, the red mask would be 0x00ff0000.
     * @param int $gBitMask Green (or U) mask for reading color data. For instance, given the A8R8G8B8 format, the green
     *                      mask would be 0x0000ff00.
     * @param int $bBitMask Blue (or V) mask for reading color data. For instance, given the A8R8G8B8 format, the blue
     *                      mask would be 0x000000ff
     * @param int $aBitMask Alpha mask for reading alpha data. The {@see DDSPixelFormat::$flags} must include
     *                      {@see Flag::ALPHA_PIXELS} or {@see Flag::ALPHA}. For instance, given the A8R8G8B8 format,
     *                      the alpha mask would be 0xff000000.
     */
    public function __construct(
        public int $size = 0,
        public array $flags = [],
        public DDSFourCC $fourCC = DDSFourCC::DXT3,
        public int $rgbBitCount = 0,
        public int $rBitMask = 0,
        public int $gBitMask = 0,
        public int $bBitMask = 0,
        public int $aBitMask = 0,
    ) {
    }

    /**
     * @param positive-int|0 $r
     * @param positive-int|0 $g
     * @param positive-int|0 $b
     * @param positive-int|0 $a
     * @return bool
     */
    public function isBitMask(int $r = 0, int $g = 0, int $b = 0, int $a = 0): bool
    {
        return $this->rBitMask === $r
            && $this->gBitMask === $g
            && $this->bBitMask === $b
            && $this->aBitMask === $a
        ;
    }

    /**
     * @param Flag $flag
     * @return bool
     */
    public function hasFlag(Flag $flag): bool
    {
        return \in_array($flag, $this->flags, true);
    }
}
