<?php

declare(strict_types=1);

namespace Bic\Image\DDS;

use Bic\Image\DDS\Metadata\DDSHeaderDXT10;
use Bic\Image\DDS\Metadata\DDSHeader;

final class DDSMetadata
{
    public function __construct(
        public readonly DDSHeader $header,
        public readonly ?DDSHeaderDXT10 $dxt10,
    ) {
    }
}
