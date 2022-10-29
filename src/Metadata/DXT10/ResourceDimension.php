<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\DXT10;

/**
 * @link https://docs.microsoft.com/en-us/windows/win32/api/d3d10/ne-d3d10-d3d10_resource_dimension
 */
enum ResourceDimension: int
{
    /**
     * Resource is of unknown type.
     */
    case UNKNOWN = 0;

    /**
     * Resource is a buffer.
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/direct3d10/d3d10-graphics-programming-guide-resources-types
     */
    case BUFFER = 1;

    /**
     * Resource is a 1D texture.
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/direct3d10/d3d10-graphics-programming-guide-resources-types
     */
    case TEXTURE1D = 2;

    /**
     * Resource is a 2D texture.
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/direct3d10/d3d10-graphics-programming-guide-resources-types
     */
    case TEXTURE2D = 3;

    /**
     * Resource is a 3D texture.
     *
     * @link https://docs.microsoft.com/en-us/windows/win32/direct3d10/d3d10-graphics-programming-guide-resources-types
     */
    case TEXTURE3D = 4;
}
