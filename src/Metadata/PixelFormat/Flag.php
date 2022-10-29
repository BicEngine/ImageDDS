<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\PixelFormat;

use Bic\Image\DDS\Metadata\DDSPixelFormat;

enum Flag: int
{
    /**
     * The surface has alpha channel information in the pixel format.
     */
    case ALPHA_PIXELS = 0x00000001;

    /**
     * Used in some older DDS files for alpha channel only uncompressed data:
     *  - {@see DDSPixelFormat::$rgbBitCount} contains the alpha channel bitcount.
     *  - {@see DDSPixelFormat::$aBitMask} contains valid data.
     */
    case ALPHA = 0x00000002;

    /**
     * Texture contains compressed RGB data;
     *  - {@see DDSPixelFormat::$fourCC} contains valid data.
     */
    case FOURCC = 0x00000004;

    /**
     * The surface is 4-bit color indexed.
     */
    case PALETTE_INDEXED_4 = 0x00000008;

    /**
     * The surface is indexed into a palette which stores indices into the
     * destination surface's 8-bit palette.
     */
    case PALETTE_INDEXED_TO_8 = 0x00000010;

    /**
     * TThe surface is 8-bit color indexed.
     */
    case PALETTE_INDEXED_8 = 0x00000020;

    /**
     * Texture contains uncompressed RGB data; {@see DDSPixelFormat::$rgbBitCount}
     * and the RGB masks:
     *  - {@see DDSPixelFormat::$rBitMask}
     *  - {@see DDSPixelFormat::$gBitMask}
     *  - {@see DDSPixelFormat::$bBitMask}
     * contain valid data.
     */
    case RGB = 0x00000040;

    /**
     * The surface will accept pixel data in the format specified and compress
     * it during the write.
     */
    case COMPRESSED = 0x00000080;

    /**
     * The surface will accept RGB data and translate it during the write to
     * YUV data. The format of the data to be written will be contained in the
     * pixel format structure. The {@see Flag::RGB} flag will be set.
     */
    case RGB_TO_YUV = 0x00000100;

    /**
     * Used in some older DDS files for YUV uncompressed data:
     *  - {@see DDSPixelFormat::$rgbBitCount} contains the YUV bit count.
     *  - {@see DDSPixelFormat::$rBitMask} contains the Y mask.
     *  - {@see DDSPixelFormat::$gBitMask} contains the U mask.
     *  - {@see DDSPixelFormat::$bBitMask} contains the V mask.
     */
    case YUV = 0x00000200;

    /**
     * Pixel format is a z-buffer only surface.
     */
    case Z_BUFFER = 0x00000400;

    /**
     * The surface is 1-bit color indexed.
     */
    case PALETTE_INDEXED_1 = 0x00000800;

    /**
     * The surface is 2-bit color indexed.
     */
    case PALETTE_INDEXED_2 = 0x00001000;

    /**
     * The surface contains Z information in the pixels.
     */
    case Z_PIXELS = 0x00002000;

    /**
     * The surface contains stencil information along with Z.
     */
    case STENCIL_BUFFER = 0x00004000;

    /**
     * Premultiplied alpha format - the color components have been premultiplied
     * by the alpha component.
     */
    case ALPHA_PREMULT = 0x00008000;

    /**
     * Used in some older DDS files for single channel color uncompressed data:
     *  - {@see DDSPixelFormat::$rgbBitCount} contains the luminance channel bit count.
     *  - {@see DDSPixelFormat::rBitMask} contains the channel mask.
     *
     * Can be combined with {@see Flag::ALPHA_PIXELS} for a two
     * channel DDS file.
     */
    case LUMINANCE = 0x00020000;

    /**
     * Luminance data in the pixel format is valid.
     *
     * Use this flag when hanging luminance off bumpmap surfaces, the bit mask
     * for the luminance portion of the pixel is then
     * ddpf.dwBumpLuminanceBitMask
     */
    case BUMP_LUMINANCE = 0x00040000;

    /**
     * Bump map dUdV data in the pixel format is valid.
     */
    case BUMP_DU_DV = 0x00080000;
}
