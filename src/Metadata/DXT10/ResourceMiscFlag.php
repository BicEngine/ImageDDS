<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\DXT10;

enum ResourceMiscFlag: int
{
    case GENERATE_MIPS = 0;
    case SHARED = 1;
    case TEXTURECUBE = 2;
    case DRAWINDIRECT_ARGS = 3;
    case BUFFER_ALLOW_RAW_VIEWS = 4;
    case BUFFER_STRUCTURED = 5;
    case RESOURCE_CLAMP = 6;
    case SHARED_KEYEDMUTEX = 7;
    case GDI_COMPATIBLE = 8;
    case SHARED_NTHANDLE = 9;
    case RESTRICTED_CONTENT = 10;
    case RESTRICT_SHARED_RESOURCE = 11;
    case RESTRICT_SHARED_RESOURCE_DRIVER = 12;
    case GUARDED = 13;
    case TILE_POOL = 14;
    case TILED = 15;
    case HW_PROTECTED = 16;
    case SHARED_DISPLAYABLE = 17;
    case SHARED_EXCLUSIVE_WRITER = 18;
}
