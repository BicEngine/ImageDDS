<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\DDSHeader;

enum Capability2: int
{
    /**
     * Required for a cube map.
     */
    case CUBEMAP = 0x00000200;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_POSITIVEX = 0x00000400;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_NEGATIVEX = 0x00000800;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_POSITIVEY = 0x00001000;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_NEGATIVEY = 0x00002000;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_POSITIVEZ = 0x00004000;

    /**
     * Required when these surfaces are stored in a cube map.
     */
    case CUBEMAP_NEGATIVEZ = 0x00008000;

    /**
     * Required for a volume texture.
     */
    case VOLUME = 0x00200000;
}
