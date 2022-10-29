<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\DXT10;

use Bic\Image\BMP\Exception\DDSException;
use Bic\Image\DDS\Metadata\DDSFourCC;
use Bic\Image\DDS\Metadata\DDSPixelFormat;
use Bic\Image\DDS\Metadata\PixelFormat\Flag as PixelFormatFlag;

/**
 * Resource data formats, including fully-typed and typeless formats. A list of
 * modifiers at the bottom of the page more fully describes each format type.
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/api/dxgiformat/ne-dxgiformat-dxgi_format
 * @codingStandardsIgnoreStart
 */
enum DXGIFormat: int
{
    /**
     * The format is not known.
     */
    case DXGI_FORMAT_UNKNOWN = 0;

    /**
     * A four-component, 128-bit typeless format that supports 32 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R32G32B32A32_TYPELESS = 1;

    /**
     * A four-component, 128-bit floating-point format that supports 32 bits
     * per channel including alpha.
     */
    case DXGI_FORMAT_R32G32B32A32_FLOAT = 2;

    /**
     * A four-component, 128-bit unsigned-integer format that supports 32 bits
     * per channel including alpha.
     */
    case DXGI_FORMAT_R32G32B32A32_UINT = 3;

    /**
     * A four-component, 128-bit signed-integer format that supports 32 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R32G32B32A32_SINT = 4;

    /**
     * A three-component, 96-bit typeless format that supports 32 bits per
     * color channel.
     */
    case DXGI_FORMAT_R32G32B32_TYPELESS = 5;

    /**
     * A three-component, 96-bit floating-point format that supports 32 bits
     * per color channel.
     */
    case DXGI_FORMAT_R32G32B32_FLOAT = 6;

    /**
     * A three-component, 96-bit unsigned-integer format that supports 32 bits
     * per color channel.
     */
    case DXGI_FORMAT_R32G32B32_UINT = 7;

    /**
     * A three-component, 96-bit signed-integer format that supports 32 bits
     * per color channel.
     */
    case DXGI_FORMAT_R32G32B32_SINT = 8;

    /**
     * A four-component, 64-bit typeless format that supports 16 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_TYPELESS = 9;

    /**
     * A four-component, 64-bit floating-point format that supports 16 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_FLOAT = 10;

    /**
     * A four-component, 64-bit unsigned-normalized-integer format that supports
     * 16 bits per channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_UNORM = 11;

    /**
     * A four-component, 64-bit unsigned-integer format that supports 16 bits
     * per channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_UINT = 12;

    /**
     * A four-component, 64-bit signed-normalized-integer format that supports
     * 16 bits per channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_SNORM = 13;

    /**
     * A four-component, 64-bit signed-integer format that supports 16 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R16G16B16A16_SINT = 14;

    /**
     * A two-component, 64-bit typeless format that supports 32 bits for the
     * red channel and 32 bits for the green channel.
     */
    case DXGI_FORMAT_R32G32_TYPELESS = 15;

    /**
     * A two-component, 64-bit floating-point format that supports 32 bits for
     * the red channel and 32 bits for the green channel.
     */
    case DXGI_FORMAT_R32G32_FLOAT = 16;

    /**
     * A two-component, 64-bit unsigned-integer format that supports 32 bits
     * for the red channel and 32 bits for the green channel.
     */
    case DXGI_FORMAT_R32G32_UINT = 17;

    /**
     * A two-component, 64-bit signed-integer format that supports 32 bits for
     * the red channel and 32 bits for the green channel.
     */
    case DXGI_FORMAT_R32G32_SINT = 18;

    /**
     * A two-component, 64-bit typeless format that supports 32 bits for the
     * red channel, 8 bits for the green channel, and 24 bits are unused.
     */
    case DXGI_FORMAT_R32G8X24_TYPELESS = 19;

    /**
     * A 32-bit floating-point component, and two unsigned-integer components
     * (with an additional 32 bits). This format supports 32-bit depth, 8-bit
     * stencil, and 24 bits are unused.
     */
    case DXGI_FORMAT_D32_FLOAT_S8X24_UINT = 20;

    /**
     * A 32-bit floating-point component, and two typeless components (with an
     * additional 32 bits). This format supports 32-bit red channel, 8 bits are
     * unused, and 24 bits are unused.
     */
    case DXGI_FORMAT_R32_FLOAT_X8X24_TYPELESS = 21;

    /**
     * A 32-bit typeless component, and two unsigned-integer components (with
     * an additional 32 bits). This format has 32 bits unused, 8 bits for green
     * channel, and 24 bits are unused.
     */
    case DXGI_FORMAT_X32_TYPELESS_G8X24_UINT = 22;

    /**
     * A four-component, 32-bit typeless format that supports 10 bits for each
     * color and 2 bits for alpha.
     */
    case DXGI_FORMAT_R10G10B10A2_TYPELESS = 23;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format that supports
     * 10 bits for each color and 2 bits for alpha.
     */
    case DXGI_FORMAT_R10G10B10A2_UNORM = 24;

    /**
     * A four-component, 32-bit unsigned-integer format that supports 10 bits
     * for each color and 2 bits for alpha.
     */
    case DXGI_FORMAT_R10G10B10A2_UINT = 25;

    /**
     * Three partial-precision floating-point numbers encoded into a single
     * 32-bit value (a variant of s10e5, which is sign bit, 10-bit mantissa,
     * and 5-bit biased (15) exponent).
     *
     * There are no sign bits, and there is a 5-bit biased (15) exponent for
     * each channel, 6-bit mantissa for R and G, and a 5-bit mantissa for B,
     * as shown in the following illustration:
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/api/dxgiformat/images/r11g11b10_float.png
     */
    case DXGI_FORMAT_R11G11B10_FLOAT = 26;

    /**
     * A four-component, 32-bit typeless format that supports 8 bits per channel
     * including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_TYPELESS = 27;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format that supports
     * 8 bits per channel including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_UNORM = 28;

    /**
     * A four-component, 32-bit unsigned-normalized integer sRGB format that
     * supports 8 bits per channel including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_UNORM_SRGB = 29;

    /**
     * A four-component, 32-bit unsigned-integer format that supports 8 bits
     * per channel including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_UINT = 30;

    /**
     * A four-component, 32-bit signed-normalized-integer format that supports
     * 8 bits per channel including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_SNORM = 31;

    /**
     * A four-component, 32-bit signed-integer format that supports 8 bits per
     * channel including alpha.
     */
    case DXGI_FORMAT_R8G8B8A8_SINT = 32;

    /**
     * A two-component, 32-bit typeless format that supports 16 bits for the red
     * channel and 16 bits for the green channel.
     */
    case DXGI_FORMAT_R16G16_TYPELESS = 33;

    /**
     * A two-component, 32-bit floating-point format that supports 16 bits for
     * the red channel and 16 bits for the green channel.
     */
    case DXGI_FORMAT_R16G16_FLOAT = 34;

    /**
     * A two-component, 32-bit unsigned-normalized-integer format that supports
     * 16 bits each for the green and red channels.
     */
    case DXGI_FORMAT_R16G16_UNORM = 35;

    /**
     * A two-component, 32-bit unsigned-integer format that supports 16 bits for
     * the red channel and 16 bits for the green channel.
     */
    case DXGI_FORMAT_R16G16_UINT = 36;

    /**
     * A two-component, 32-bit signed-normalized-integer format that supports
     * 16 bits for the red channel and 16 bits for the green channel.
     */
    case DXGI_FORMAT_R16G16_SNORM = 37;

    /**
     * A two-component, 32-bit signed-integer format that supports 16 bits for
     * the red channel and 16 bits for the green channel.
     */
    case DXGI_FORMAT_R16G16_SINT = 38;

    /**
     * A single-component, 32-bit typeless format that supports 32 bits for
     * the red channel.
     */
    case DXGI_FORMAT_R32_TYPELESS = 39;

    /**
     * A single-component, 32-bit floating-point format that supports 32 bits
     * for depth.
     */
    case DXGI_FORMAT_D32_FLOAT = 40;

    /**
     * A single-component, 32-bit floating-point format that supports 32 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R32_FLOAT = 41;

    /**
     * A single-component, 32-bit unsigned-integer format that supports 32 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R32_UINT = 42;

    /**
     * A single-component, 32-bit signed-integer format that supports 32 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R32_SINT = 43;

    /**
     * A two-component, 32-bit typeless format that supports 24 bits for the
     * red channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R24G8_TYPELESS = 44;

    /**
     * A 32-bit z-buffer format that supports 24 bits for depth and 8 bits
     * for stencil.
     */
    case DXGI_FORMAT_D24_UNORM_S8_UINT = 45;

    /**
     * A 32-bit format, that contains a 24 bit, single-component,
     * unsigned-normalized integer, with an additional typeless 8 bits. This
     * format has 24 bits red channel and 8 bits unused.
     */
    case DXGI_FORMAT_R24_UNORM_X8_TYPELESS = 46;

    /**
     * A 32-bit format, that contains a 24 bit, single-component, typeless
     * format, with an additional 8 bit unsigned integer component. This format
     * has 24 bits unused and 8 bits green channel.
     */
    case DXGI_FORMAT_X24_TYPELESS_G8_UINT = 47;

    /**
     * A two-component, 16-bit typeless format that supports 8 bits for the red
     * channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R8G8_TYPELESS = 48;

    /**
     * A two-component, 16-bit unsigned-normalized-integer format that supports
     * 8 bits for the red channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R8G8_UNORM = 49;

    /**
     * A two-component, 16-bit unsigned-integer format that supports 8 bits for
     * the red channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R8G8_UINT = 50;

    /**
     * A two-component, 16-bit signed-normalized-integer format that supports
     * 8 bits for the red channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R8G8_SNORM = 51;

    /**
     * A two-component, 16-bit signed-integer format that supports 8 bits for
     * the red channel and 8 bits for the green channel.
     */
    case DXGI_FORMAT_R8G8_SINT = 52;

    /**
     * A single-component, 16-bit typeless format that supports 16 bits for
     * the red channel.
     */
    case DXGI_FORMAT_R16_TYPELESS = 53;

    /**
     * A single-component, 16-bit floating-point format that supports 16 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R16_FLOAT = 54;

    /**
     * A single-component, 16-bit unsigned-normalized-integer format that
     * supports 16 bits for depth.
     */
    case DXGI_FORMAT_D16_UNORM = 55;

    /**
     * A single-component, 16-bit unsigned-normalized-integer format that
     * supports 16 bits for the red channel.
     */
    case DXGI_FORMAT_R16_UNORM = 56;

    /**
     * A single-component, 16-bit unsigned-integer format that supports 16 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R16_UINT = 57;

    /**
     * A single-component, 16-bit signed-normalized-integer format that supports
     * 16 bits for the red channel.
     */
    case DXGI_FORMAT_R16_SNORM = 58;

    /**
     * A single-component, 16-bit signed-integer format that supports 16 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R16_SINT = 59;

    /**
     * A single-component, 8-bit typeless format that supports 8 bits for the
     * red channel.
     */
    case DXGI_FORMAT_R8_TYPELESS = 60;

    /**
     * A single-component, 8-bit unsigned-normalized-integer format that
     * supports 8 bits for the red channel.
     */
    case DXGI_FORMAT_R8_UNORM = 61;

    /**
     * A single-component, 8-bit unsigned-integer format that supports 8 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R8_UINT = 62;

    /**
     * A single-component, 8-bit signed-normalized-integer format that supports
     * 8 bits for the red channel.
     */
    case DXGI_FORMAT_R8_SNORM = 63;

    /**
     * A single-component, 8-bit signed-integer format that supports 8 bits
     * for the red channel.
     */
    case DXGI_FORMAT_R8_SINT = 64;

    /**
     * A single-component, 8-bit unsigned-normalized-integer format for
     * alpha only.
     */
    case DXGI_FORMAT_A8_UNORM = 65;

    /**
     * A single-component, 1-bit unsigned-normalized integer format that
     * supports 1 bit for the red channel.
     */
    case DXGI_FORMAT_R1_UNORM = 66;

    /**
     * Three partial-precision floating-point numbers encoded into a single
     * 32-bit value all sharing the same 5-bit exponent (variant of s10e5,
     * which is sign bit, 10-bit mantissa, and 5-bit biased (15) exponent).
     *
     * There is no sign bit, and there is a shared 5-bit biased (15) exponent
     * and a 9-bit mantissa for each channel, as shown in the following
     * illustration:
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/api/dxgiformat/images/rgbe.png
     */
    case DXGI_FORMAT_R9G9B9E5_SHAREDEXP = 67;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format. This packed
     * RGB format is analogous to the UYVY format. Each 32-bit block describes a
     * pair of pixels: (R8, G8, B8) and (R8, G8, B8) where the R8/B8 values are
     * repeated, and the G8 values are unique to each pixel.
     *
     * Width must be even.
     */
    case DXGI_FORMAT_R8G8_B8G8_UNORM = 68;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format. This packed
     * RGB format is analogous to the YUY2 format. Each 32-bit block describes
     * a pair of pixels: (R8, G8, B8) and (R8, G8, B8) where the R8/B8 values
     * are repeated, and the G8 values are unique to each pixel.
     *
     * Width must be even.
     */
    case DXGI_FORMAT_G8R8_G8B8_UNORM = 69;

    /**
     * Four-component typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC1_TYPELESS = 70;

    /**
     * Four-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC1_UNORM = 71;

    /**
     * Four-component block-compression format for sRGB data.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC1_UNORM_SRGB = 72;

    /**
     * Four-component typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC2_TYPELESS = 73;

    /**
     * Four-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC2_UNORM = 74;

    /**
     * Four-component block-compression format for sRGB data.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC2_UNORM_SRGB = 75;

    /**
     * Four-component typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC3_TYPELESS = 76;

    /**
     * Four-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC3_UNORM = 77;

    /**
     * Four-component block-compression format for sRGB data.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC3_UNORM_SRGB = 78;

    /**
     * One-component typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC4_TYPELESS = 79;

    /**
     * One-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC4_UNORM = 80;

    /**
     * One-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC4_SNORM = 81;

    /**
     * Two-component typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC5_TYPELESS = 82;

    /**
     * Two-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC5_UNORM = 83;

    /**
     * Two-component block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC5_SNORM = 84;

    /**
     * A three-component, 16-bit unsigned-normalized-integer format that
     * supports 5 bits for blue, 6 bits for green, and 5 bits for red.
     *  - Direct3D 10 through Direct3D 11: This value is defined for DXGI.
     *    However, Direct3D 10, 10.1, or 11 devices do not support this format.
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_B5G6R5_UNORM = 85;

    /**
     * A four-component, 16-bit unsigned-normalized-integer format that
     * supports 5 bits for each color channel and 1-bit alpha.
     *  - Direct3D 10 through Direct3D 11: This value is defined for DXGI.
     *    However, Direct3D 10, 10.1, or 11 devices do not support this format.
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_B5G5R5A1_UNORM = 86;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format that
     * supports 8 bits for each color channel and 8-bit alpha.
     */
    case DXGI_FORMAT_B8G8R8A8_UNORM = 87;

    /**
     * A four-component, 32-bit unsigned-normalized-integer format that supports
     * 8 bits for each color channel and 8 bits unused.
     */
    case DXGI_FORMAT_B8G8R8X8_UNORM = 89;

    /**
     * A four-component, 32-bit 2.8-biased fixed-point format that supports 10
     * bits for each color channel and 2-bit alpha.
     */
    case DXGI_FORMAT_R10G10B10_XR_BIAS_A2_UNORM = 90;

    /**
     * A four-component, 32-bit typeless format that supports 8 bits for each
     * channel including alpha.
     */
    case DXGI_FORMAT_B8G8R8A8_TYPELESS = 91;

    /**
     * A four-component, 32-bit unsigned-normalized standard RGB format that
     * supports 8 bits for each channel including alpha.
     */
    case DXGI_FORMAT_B8G8R8A8_UNORM_SRGB = 92;

    /**
     * A four-component, 32-bit typeless format that supports 8 bits for each
     * color channel, and 8 bits are unused.
     */
    case DXGI_FORMAT_B8G8R8X8_TYPELESS = 93;

    /**
     * A four-component, 32-bit unsigned-normalized standard RGB format that
     * supports 8 bits for each color channel, and 8 bits are unused.
     */
    case DXGI_FORMAT_B8G8R8X8_UNORM_SRGB = 94;

    /**
     * A typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC6H_TYPELESS = 95;

    /**
     * A block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC6H_UF16 = 96;

    /**
     * A block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC6H_SF16 = 97;

    /**
     * A typeless block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC7_TYPELESS = 98;

    /**
     * A block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC7_UNORM = 99;

    /**
     * A block-compression format.
     *
     * For information about block-compression formats,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/direct3d11/texture-block-compression-in-direct3d-11}.
     */
    case DXGI_FORMAT_BC7_UNORM_SRGB = 100;

    /**
     * Most common YUV 4:4:4 video resource format. Valid view formats for this
     * video resource format are {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT}. For UAVs, an additional
     * valid view format is {@see DXGIFormat::DXGI_FORMAT_R32_UINT}. By
     * using {@see DXGIFormat::DXGI_FORMAT_R32_UINT} for UAVs, you can both read
     * and write as opposed to just write
     * for {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT}. Supported view types
     * are SRV, RTV, and UAV. One view provides a straightforward mapping of the
     * entire surface.
     *
     * The mapping to the view channel is:
     *  - V -> R8
     *  - U -> G8
     *  - Y -> B8
     *  - A -> A8
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_AYUV = 101;

    /**
     * 10-bit per channel packed YUV 4:4:4 video resource format. Valid view
     * formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R10G10B10A2_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R10G10B10A2_UINT}. For UAVs, an
     * additional valid view format is {@see DXGIFormat::DXGI_FORMAT_R32_UINT}.
     * By using {@see DXGIFormat::DXGI_FORMAT_R32_UINT} for UAVs, you can both
     * read and write as opposed to just write
     * for {@see DXGIFormat::DXGI_FORMAT_R10G10B10A2_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R10G10B10A2_UINT}. Supported view types
     * are SRV and UAV. One view provides a straightforward mapping of the
     * entire surface.
     *
     * The mapping to the view channel is:
     *  - U -> R10
     *  - Y -> G10
     *  - V -> B10
     *  - A -> A2
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_Y410 = 102;

    /**
     * 16-bit per channel packed YUV 4:4:4 video resource format. Valid view
     * formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UINT}. Supported view
     * types are SRV and UAV. One view provides a straightforward mapping of the
     * entire surface.
     *
     * The mapping to the view channel is:
     *  - U -> R16
     *  - Y -> G16
     *  - V -> B16
     *  - A -> A16
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_Y416 = 103;

    /**
     * Most common YUV 4:2:0 video resource format. Valid luminance data view
     * formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8_UINT}. Valid chrominance data view
     * formats (width and height are each 1/2 of luminance view) for this video
     * resource format are {@see DXGIFormat::DXGI_FORMAT_R8G8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8_UINT}. Supported view types are
     * SRV, RTV, and UAV. For luminance data view, the mapping to the view
     * channel is Y -> R8. For chrominance data view, the mapping to the view
     * channel is U -> R8 and V -> G8.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width and height must be even. Direct3D 11 staging resources and initData
     * parameters for this format use (rowPitch * (height + (height / 2))) bytes.
     * The first (SysMemPitch * height) bytes are the Y plane, the
     * remaining (SysMemPitch * (height / 2)) bytes are the UV plane.
     *
     * An app using the YUY 4:2:0 formats must map the luma (Y) plane separately
     * from the chroma (UV) planes. Developers do this by
     * calling ID3D12Device::CreateShaderResourceView twice for the same texture
     * and passing in 1-channel and 2-channel formats. Passing in a 1-channel
     * format compatible with the Y plane maps only the Y plane. Passing in a
     * 2-channel format compatible with the UV planes (together) maps only the
     * U and V planes as a single resource view.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_NV12 = 104;

    /**
     * 10-bit per channel planar YUV 4:2:0 video resource format. Valid
     * luminance data view formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16_UINT}. The runtime does not enforce
     * whether the lowest 6 bits are 0 (given that this video resource format
     * is a 10-bit format that uses 16 bits). If required, application shader
     * code would have to enforce this manually. From the runtime's point of
     * view, {@see DXGIFormat::DXGI_FORMAT_P010} is no different
     * than {@see DXGIFormat::DXGI_FORMAT_P016}. Valid chrominance data view
     * formats (width and height are each 1/2 of luminance view) for this video
     * resource format are {@see DXGIFormat::DXGI_FORMAT_R16G16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16_UINT}. For UAVs, an additional
     * valid chrominance data view format
     * is {@see DXGIFormat::DXGI_FORMAT_R32_UINT}. By
     * using {@see DXGIFormat::DXGI_FORMAT_R32_UINT} for UAVs, you can both read
     * and write as opposed to just write
     * for {@see DXGIFormat::DXGI_FORMAT_R16G16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16_UINT}. Supported view types are
     * SRV, RTV, and UAV. For luminance data view, the mapping to the view
     * channel is Y -> R16. For chrominance data view, the mapping to the view
     * channel is U -> R16 and V -> G16.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width and height must be even. Direct3D 11 staging resources and initData
     * parameters for this format use (rowPitch * (height + (height / 2)))
     * bytes. The first (SysMemPitch * height) bytes are the Y plane, the
     * remaining (SysMemPitch * (height / 2)) bytes are the UV plane.
     *
     * An app using the YUY 4:2:0 formats must map the luma (Y) plane separately
     * from the chroma (UV) planes. Developers do this by
     * calling ID3D12Device::CreateShaderResourceView twice for the same texture
     * and passing in 1-channel and 2-channel formats. Passing in a 1-channel
     * format compatible with the Y plane maps only the Y plane. Passing in a
     * 2-channel format compatible with the UV planes (together) maps only
     * the U and V planes as a single resource view.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_P010 = 105;

    /**
     * 16-bit per channel planar YUV 4:2:0 video resource format. Valid
     * luminance data view formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16_UINT}. Valid chrominance data view
     * formats (width and height are each 1/2 of luminance view) for this video
     * resource format are {@see DXGIFormat::DXGI_FORMAT_R16G16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16_UINT}. For UAVs, an additional
     * valid chrominance data view format
     * is {@see DXGIFormat::DXGI_FORMAT_R32_UINT}. By
     * using {@see DXGIFormat::DXGI_FORMAT_R32_UINT} for UAVs, you can both read
     * and write as opposed to just write
     * for {@see DXGIFormat::DXGI_FORMAT_R16G16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16_UINT}. Supported view types are
     * SRV, RTV, and UAV. For luminance data view, the mapping to the view
     * channel is Y -> R16. For chrominance data view, the mapping to the view
     * channel is U -> R16 and V -> G16.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width and height must be even. Direct3D 11 staging resources and initData
     * parameters for this format use (rowPitch * (height + (height / 2)))
     * bytes. The first (SysMemPitch * height) bytes are the Y plane, the
     * remaining (SysMemPitch * (height / 2)) bytes are the UV plane.
     *
     * An app using the YUY 4:2:0 formats must map the luma (Y) plane
     * separately from the chroma (UV) planes. Developers do this by
     * calling ID3D12Device::CreateShaderResourceView twice for the same
     * texture and passing in 1-channel and 2-channel formats. Passing in a
     * 1-channel format compatible with the Y plane maps only the Y plane.
     * Passing in a 2-channel format compatible with the UV planes (together)
     * maps only the U and V planes as a single resource view.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_P016 = 106;

    /**
     * 8-bit per channel planar YUV 4:2:0 video resource format. This format is
     * subsampled where each pixel has its own Y value, but each 2x2 pixel block
     * shares a single U and V value. The runtime requires that the width and
     * height of all resources that are created with this format are multiples
     * of 2. The runtime also requires that the left, right, top, and bottom
     * members of any RECT that are used for this format are multiples of 2.
     * This format differs from {@see DXGIFormat::DXGI_FORMAT_NV12} in that the
     * layout of the data within the resource is completely opaque to
     * applications. Applications cannot use the CPU to map the resource and
     * then access the data within the resource. You cannot use shaders with
     * this format. Because of this behavior, legacy hardware that supports a
     * non-NV12 4:2:0 layout (for example, YV12, and so on) can be used. Also,
     * new hardware that has a 4:2:0 implementation better than NV12 can be
     * used when the application does not need the data to be in a standard
     * layout.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width and height must be even. Direct3D 11 staging resources and initData
     * parameters for this format use (rowPitch * (height + (height / 2))) bytes.
     *
     * An app using the YUY 4:2:0 formats must map the luma (Y) plane separately
     * from the chroma (UV) planes. Developers do this by
     * calling ID3D12Device::CreateShaderResourceView twice for the same texture
     * and passing in 1-channel and 2-channel formats. Passing in a 1-channel
     * format compatible with the Y plane maps only the Y plane. Passing in a
     * 2-channel format compatible with the UV planes (together) maps only the
     * U and V planes as a single resource view.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_420_OPAQUE = 107;

    /**
     * Most common YUV 4:2:2 video resource format. Valid view formats for this
     * video resource format are {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT}. For UAVs, an additional
     * valid view format is {@see DXGIFormat::DXGI_FORMAT_R32_UINT}. By
     * using {@see DXGIFormat::DXGI_FORMAT_R32_UINT} for UAVs, you can both read
     * and write as opposed to just write
     * for {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT}. Supported view types
     * are SRV and UAV. One view provides a straightforward mapping of the
     * entire surface.
     *
     * The mapping to the view channel is:
     *  - Y0 -> R8
     *  - U0 -> G8
     *  - Y1 -> B8
     *  - V0 -> A8
     *
     * A unique valid view format for this video resource format
     * is {@see DXGIFormat::DXGI_FORMAT_R8G8_B8G8_UNORM}. With this view format,
     * the width of the view appears to be twice what
     * the {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM}
     * or {@see DXGIFormat::DXGI_FORMAT_R8G8B8A8_UINT} view would be when
     * hardware reconstructs RGBA automatically on read and before filtering.
     * This Direct3D hardware behavior is legacy and is likely not useful any
     * more.
     *
     * With this view format, the mapping to the view channel is:
     *  - Y0 -> R8
     *  - U0 -> G8[0]
     *  - Y1 -> B8
     *  - V0 -> G8[1]
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width must be even.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_YUY2 = 108;

    /**
     * 10-bit per channel packed YUV 4:2:2 video resource format. Valid
     * view formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UINT}. The runtime does
     * not enforce whether the lowest 6 bits are 0 (given that this video
     * resource format is a 10-bit format that uses 16 bits). If required,
     * application shader code would have to enforce this manually. From the
     * runtime's point of view, {@see DXGIFormat::DXGI_FORMAT_Y210} is no
     * different than {@see DXGIFormat::DXGI_FORMAT_Y216}. Supported view types
     * are SRV and UAV. One view provides a straightforward mapping of the
     * entire surface.
     *
     * The mapping to the view channel is:
     *  - Y0 -> R16
     *  - U -> G16
     *  - Y1 -> B16
     *  - V -> A16
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width must be even.
     *
     * - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_Y210 = 109;

    /**
     * 16-bit per channel packed YUV 4:2:2 video resource format. Valid view
     * formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R16G16B16A16_UINT}. Supported view
     * types are SRV and UAV. One view provides a straightforward mapping of
     * the entire surface.
     *
     * The mapping to the view channel is:
     *  - Y0 -> R16
     *  - U -> G16
     *  - Y1 -> B16
     *  - V -> A16
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width must be even.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_Y216 = 110;

    /**
     * Most common planar YUV 4:1:1 video resource format. Valid luminance data
     * view formats for this video resource format
     * are {@see DXGIFormat::DXGI_FORMAT_R8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8_UINT}. Valid chrominance data view
     * formats (width and height are each 1/4 of luminance view) for this video
     * resource format are {@see DXGIFormat::DXGI_FORMAT_R8G8_UNORM}
     * and {@see DXGIFormat::DXGI_FORMAT_R8G8_UINT}. Supported view types are
     * SRV, RTV, and UAV. For luminance data view, the mapping to the view
     * channel is Y -> R8. For chrominance data view, the mapping to the view
     * channel is U -> R8 and V -> G8.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     * Width must be a multiple of 4. Direct3D11 staging resources and initData
     * parameters for this format use (rowPitch * height * 2) bytes. The
     * first (SysMemPitch * height) bytes are the Y plane, the
     * next ((SysMemPitch / 2) * height) bytes are the UV plane, and the
     * remainder is padding.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_NV11 = 111;

    /**
     * 4-bit palletized YUV format that is commonly used for DVD subpicture.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_AI44 = 112;

    /**
     * 4-bit palletized YUV format that is commonly used for DVD subpicture.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_IA44 = 113;

    /**
     * 8-bit palletized format that is used for palletized RGB data when the
     * processor processes ISDB-T data and for palletized YUV data when the
     * processor processes BluRay data.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_P8 = 114;

    /**
     * 8-bit palletized format with 8 bits of alpha that is used for palletized
     * YUV data when the processor processes BluRay data.
     *
     * For more info about YUV formats for video rendering,
     * see {@link https://docs.microsoft.com/en-us/windows/desktop/medfound/recommended-8-bit-yuv-formats-for-video-rendering}
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_A8P8 = 115;

    /**
     * A four-component, 16-bit unsigned-normalized integer format that supports
     * 4 bits for each channel including alpha.
     *
     *  - Direct3D 11.1: This value is not supported until Windows 8.
     */
    case DXGI_FORMAT_B4G4R4A4_UNORM = 116;

    /**
     * A video format; an 8-bit version of a hybrid planar 4:2:2 format.
     */
    case DXGI_FORMAT_P208 = 117;

    /**
     * An 8 bit YCbCrA 4:4 rendering format.
     */
    case DXGI_FORMAT_V208 = 118;

    /**
     * An 8 bit YCbCrA 4:4:4:4 rendering format.
     */
    case DXGI_FORMAT_V408 = 119;

    case DXGI_FORMAT_SAMPLER_FEEDBACK_MIN_MIP_OPAQUE = 120;
    case DXGI_FORMAT_SAMPLER_FEEDBACK_MIP_REGION_USED_OPAQUE = 121;

    /**
     * Forces this enumeration to compile to 32 bits in size. Without this
     * value, some compilers would allow this enumeration to compile to a
     * size other than 32 bits. This value is not used.
     */
    case DXGI_FORMAT_FORCE_UINT = 122;

    /**
     * @return bool
     */
    public function isCompressedBlock(): bool
    {
        return $this === self::DXGI_FORMAT_BC1_TYPELESS
            || $this === self::DXGI_FORMAT_BC1_UNORM
            || $this === self::DXGI_FORMAT_BC1_UNORM_SRGB
            || $this === self::DXGI_FORMAT_BC4_TYPELESS
            || $this === self::DXGI_FORMAT_BC4_UNORM
            || $this === self::DXGI_FORMAT_BC4_SNORM
            || $this === self::DXGI_FORMAT_BC2_TYPELESS
            || $this === self::DXGI_FORMAT_BC2_UNORM
            || $this === self::DXGI_FORMAT_BC2_UNORM_SRGB
            || $this === self::DXGI_FORMAT_BC3_TYPELESS
            || $this === self::DXGI_FORMAT_BC3_UNORM
            || $this === self::DXGI_FORMAT_BC3_UNORM_SRGB
            || $this === self::DXGI_FORMAT_BC5_TYPELESS
            || $this === self::DXGI_FORMAT_BC5_UNORM
            || $this === self::DXGI_FORMAT_BC5_SNORM
            || $this === self::DXGI_FORMAT_BC6H_TYPELESS
            || $this === self::DXGI_FORMAT_BC6H_UF16
            || $this === self::DXGI_FORMAT_BC6H_SF16
            || $this === self::DXGI_FORMAT_BC7_TYPELESS
            || $this === self::DXGI_FORMAT_BC7_UNORM
            || $this === self::DXGI_FORMAT_BC7_UNORM_SRGB
        ;
    }

    /**
     * @return positive-int
     * @throws DDSException
     */
    public function getBytesPerBlock(): int
    {
        return match ($this) {
            self::DXGI_FORMAT_NV12,
            self::DXGI_FORMAT_420_OPAQUE,
            self::DXGI_FORMAT_P208 => 2,

            self::DXGI_FORMAT_P010,
            self::DXGI_FORMAT_P016,
            self::DXGI_FORMAT_R8G8_B8G8_UNORM,
            self::DXGI_FORMAT_G8R8_G8B8_UNORM,
            self::DXGI_FORMAT_YUY2 => 4,

            self::DXGI_FORMAT_Y210,
            self::DXGI_FORMAT_Y216,
            self::DXGI_FORMAT_BC1_TYPELESS,
            self::DXGI_FORMAT_BC1_UNORM,
            self::DXGI_FORMAT_BC1_UNORM_SRGB,
            self::DXGI_FORMAT_BC4_TYPELESS,
            self::DXGI_FORMAT_BC4_UNORM,
            self::DXGI_FORMAT_BC4_SNORM => 8,

            self::DXGI_FORMAT_BC2_TYPELESS,
            self::DXGI_FORMAT_BC2_UNORM,
            self::DXGI_FORMAT_BC2_UNORM_SRGB,
            self::DXGI_FORMAT_BC3_TYPELESS,
            self::DXGI_FORMAT_BC3_UNORM,
            self::DXGI_FORMAT_BC3_UNORM_SRGB,
            self::DXGI_FORMAT_BC5_TYPELESS,
            self::DXGI_FORMAT_BC5_UNORM,
            self::DXGI_FORMAT_BC5_SNORM,
            self::DXGI_FORMAT_BC6H_TYPELESS,
            self::DXGI_FORMAT_BC6H_UF16,
            self::DXGI_FORMAT_BC6H_SF16,
            self::DXGI_FORMAT_BC7_TYPELESS,
            self::DXGI_FORMAT_BC7_UNORM,
            self::DXGI_FORMAT_BC7_UNORM_SRGB => 16,
            default => throw new DDSException(
                \sprintf('Unable to determine compression block; The %s format is not compressed', $this->name)
            ),
        };
    }

    /**
     * @param DDSPixelFormat $format
     * @return static
     * @psalm-suppress UnhandledMatchCondition
     */
    public static function fromPixelFormat(DDSPixelFormat $format): self
    {
        try {
            return match (true) {
                $format->hasFlag(PixelFormatFlag::RGB) => match ($format->rgbBitCount) {
                    32 => match (true) {
                        $format->isBitMask(0x000000FF, 0x0000FF00, 0x00FF0000, 0xFF000000) =>
                            DXGIFormat::DXGI_FORMAT_R8G8B8A8_UNORM,
                        $format->isBitMask(0x00FF0000, 0x0000FF00, 0x000000FF, 0xFF000000) =>
                            DXGIFormat::DXGI_FORMAT_B8G8R8A8_UNORM,
                        $format->isBitMask(0x00FF0000, 0x0000FF00, 0x000000FF) =>
                            DXGIFormat::DXGI_FORMAT_B8G8R8X8_UNORM,
                        // No DXGI format [0x000000ff, 0x0000ff00, 0x00ff0000, 0] aka D3DFMT_X8B8G8R8
                        //
                        // Note that many common DDS reader/writers (including D3DX) swap the
                        // the RED/BLUE masks for 10:10:10:2 formats. We assume
                        // below that the 'backwards' header mask is being used since it is most
                        // likely written by D3DX. The more robust solution is to use the 'DX10'
                        // header extension and specify the DXGI_FORMAT_R10G10B10A2_UNORM format directly.
                        //
                        // For 'correct' writers, this should be 0x000003FF, 0x000FFC00, 0x3FF00000 for RGB data
                        $format->isBitMask(0x3FF0_0000, 0x000F_FC00, 0x0000_03FF, 0xC000_0000) =>
                            DXGIFormat::DXGI_FORMAT_R10G10B10A2_UNORM,
                        // No DXGI format [0x000003FF, 0x000FFC00, 0x3FF00000, 0xC0000000] aka D3DFMT_A2R10G10B10
                        $format->isBitMask(0x0000_FFFF, 0xFFFF_0000) =>
                            DXGIFormat::DXGI_FORMAT_R16G16_UNORM,
                        $format->isBitMask(0xFFFF_FFFF) =>
                            // Only 32-bit color channel format in D3D9 was R32F
                            // D3DX writes this out as a FourCC of 114
                            DXGIFormat::DXGI_FORMAT_R32_FLOAT,
                    },
                    // No 24bpp DXGI formats aka D3DFMT_R8G8B8
                    16 => match (true) {
                        $format->isBitMask(0x7C00, 0x03E0, 0x001F, 0x8000) =>
                            DXGIFormat::DXGI_FORMAT_B5G5R5A1_UNORM,
                        $format->isBitMask(0xF800, 0x07E0, 0x001F) =>
                            DXGIFormat::DXGI_FORMAT_B5G6R5_UNORM,
                        // No DXGI format [0x7c00, 0x03e0, 0x001f, 0] aka D3DFMT_X1R5G5B5
                        $format->isBitMask(0x0F00, 0x00F0, 0x000F, 0xF000) =>
                            DXGIFormat::DXGI_FORMAT_B4G4R4A4_UNORM,
                        // NVTT versions 1.x wrote this as RGB instead of LUMINANCE
                        $format->isBitMask(0x00FF, a: 0xFF00) =>
                            DXGIFormat::DXGI_FORMAT_R8G8_UNORM,
                        $format->isBitMask(0xFFFF) =>
                            DXGIFormat::DXGI_FORMAT_R16_UNORM,
                        // No DXGI format [0x0f00, 0x00f0, 0x000f, 0] aka D3DFMT_X4R4G4B4,
                        // No 3:3:2:8 or paletted DXGI formats aka D3DFMT_A8R3G3B2, D3DFMT_A8P8, etc.
                    },
                    8 => match (true) {
                        // NVTT versions 1.x wrote this as RGB instead of LUMINANCE
                        $format->isBitMask(0xFF) =>
                            DXGIFormat::DXGI_FORMAT_R8_UNORM,
                        // No 3:3:2 or paletted DXGI formats aka D3DFMT_R3G3B2, D3DFMT_P8
                    },
                },
                $format->hasFlag(PixelFormatFlag::LUMINANCE) => match ($format->rgbBitCount) {
                    16 => match (true) {
                        $format->isBitMask(0xFFFF) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R16_UNORM,
                        $format->isBitMask(0x00FF, a: 0xFF00) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R8G8_UNORM,
                    },
                    8 => match (true) {
                        $format->isBitMask(0xFF) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R8_UNORM,
                        // No DXGI format [0x0F, 0, 0, 0xF0] aka D3DFMT_A4L4
                        $format->isBitMask(0x00FF, a: 0xFF00) =>
                            // Some DDS writers assume the bitcount should be
                            // 8 instead of 16
                            DXGIFormat::DXGI_FORMAT_R8G8_UNORM,
                    },
                },
                $format->hasFlag(PixelFormatFlag::ALPHA) => match ($format->rgbBitCount) {
                    8 => DXGIFormat::DXGI_FORMAT_A8_UNORM,
                },
                $format->hasFlag(PixelFormatFlag::BUMP_DU_DV) => match ($format->rgbBitCount) {
                    32 => match (true) {
                        $format->isBitMask(0x0000_00FF, 0x0000_FF00, 0x00FF_0000, 0xFF00_0000) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R8G8B8A8_SNORM,
                        $format->isBitMask(0x0000_FFFF, 0xFFFF_0000) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R16G16_SNORM,
                        // No DXGI format [0x3FF00000, 0x000FFC00, 0x000003FF, 0xc0000000] aka D3DFMT_A2W10V10U10
                    },
                    16 => match (true) {
                        $format->isBitMask(0x00FF, 0xFF00) =>
                            // D3DX10/11 writes this out as DX10 extension
                            DXGIFormat::DXGI_FORMAT_R8G8_SNORM,
                    },
                    // No DXGI format maps to PixelFormatFlag::BUMP_LUMINANCE aka D3DFMT_L6V5U5, D3DFMT_X8L8V8U8
                },
                $format->hasFlag(PixelFormatFlag::FOURCC) => match ($format->fourCC) {
                    DDSFourCC::DXT1 => DXGIFormat::DXGI_FORMAT_BC1_UNORM,
                    DDSFourCC::DXT2, DDSFourCC::DXT3 => DXGIFormat::DXGI_FORMAT_BC2_UNORM,
                    DDSFourCC::DXT4, DDSFourCC::DXT5 => DXGIFormat::DXGI_FORMAT_BC3_UNORM,
                    DDSFourCC::ATI1, DDSFourCC::BC4U => DXGIFormat::DXGI_FORMAT_BC4_UNORM,
                    DDSFourCC::BC4S => DXGIFormat::DXGI_FORMAT_BC4_SNORM,
                    DDSFourCC::ATI2, DDSFourCC::BC5U => DXGIFormat::DXGI_FORMAT_BC5_UNORM,
                    DDSFourCC::BC5S => DXGIFormat::DXGI_FORMAT_BC5_SNORM,
                    // BC6H and BC7 are written using the "DX10" extended header.
                    DDSFourCC::RGBG => DXGIFormat::DXGI_FORMAT_R8G8_B8G8_UNORM,
                    DDSFourCC::GRGB => DXGIFormat::DXGI_FORMAT_G8R8_G8B8_UNORM,
                    DDSFourCC::YUY2 => DXGIFormat::DXGI_FORMAT_YUY2,
                },
            };
        } catch (\UnhandledMatchError) {
            return DXGIFormat::DXGI_FORMAT_UNKNOWN;
        }
    }
}
