<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata\DXT10;

/**
 * @link https://docs.microsoft.com/en-us/windows/win32/direct3ddds/dds-header-dxt10
 */
enum AlphaMode: int
{
    /**
     * Alpha channel content is unknown. This is the value for legacy files,
     * which typically is assumed to be 'straight' alpha.
     */
    case UNKNOWN = 0;

    /**
     * Any alpha channel content is presumed to use straight alpha.
     */
    case STRAIGHT = 1;

    /**
     * Any alpha channel content is using premultiplied alpha. The only legacy
     * file formats that indicate this information are 'DX2' and 'DX4'.
     */
    case PREMULTIPLIED = 2;

    /**
     * Any alpha channel content is all set to fully opaque.
     */
    case OPAQUE = 3;

    /**
     * Any alpha channel content is being used as a 4th channel and is not
     * intended to represent transparency (straight or premultiplied).
     */
    case CUSTOM = 4;
}
