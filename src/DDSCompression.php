<?php

declare(strict_types=1);

namespace Bic\Image\DDS;

use Bic\Image\CompressionInterface;

enum DDSCompression implements CompressionInterface
{
    case BC1;
    case BC2;
    case BC3;
    case BC4;
    case BC5;
    case BC6;
    case BC7;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
