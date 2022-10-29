<?php

declare(strict_types=1);

namespace Bic\Image\DDS\Metadata;

use Bic\Image\DDS\Metadata\DDSHeader\Capability;
use Bic\Image\DDS\Metadata\DDSHeader\Capability2;
use Bic\Image\DDS\Metadata\DDSHeader\Flag;

/**
 * Describes a DDS file header.
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/direct3ddds/dds-header
 */
final class DDSHeader
{
    /**
     * @param positive-int|0 $size Size of structure. This member must be set to 124.
     * @param list<Flag> $flags Flags to indicate which members contain valid data.
     * @param positive-int|0 $height Surface height (in pixels).
     * @param positive-int|0 $width Surface width (in pixels).
     * @param positive-int|0 $pitchOrLinearSize The pitch or number of bytes per scan line in an uncompressed
     *        texture; the total number of bytes in the top level texture for a compressed texture. For information
     *        about how to compute the pitch, see the DDS File Layout section of
     *        the {@link https://docs.microsoft.com/en-us/windows/win32/direct3ddds/dx-graphics-dds-pguide}.
     * @param positive-int|0 $depth Depth of a volume texture (in pixels), otherwise unused.
     * @param positive-int|0 $mipMapCount Number of mipmap levels, otherwise unused.
     * @param array<positive-int|0> $reserved1 Unused.
     * @param DDSPixelFormat $format The pixel format.
     * @param array<Capability> $caps Specifies the complexity of the surfaces stored.
     * @param array<Capability2> $caps2 Additional detail about the surfaces stored.
     * @param array<positive-int|0> $reserved2 Unused.
     */
    public function __construct(
        public readonly int $size = 0,
        public readonly array $flags = [Flag::CAPS, Flag::HEIGHT, Flag::WIDTH, Flag::PIXEL_FORMAT],
        public readonly int $height = 0,
        public readonly int $width = 0,
        public readonly int $pitchOrLinearSize = 0,
        public readonly int $depth = 0,
        public readonly int $mipMapCount = 0,
        public readonly array $reserved1 = [],
        public readonly DDSPixelFormat $format = new DDSPixelFormat(),
        public readonly array $caps = [Capability::TEXTURE],
        public readonly array $caps2 = [],
        public readonly array $reserved2 = [],
    ) {
    }

    /**
     * @return bool
     */
    public function hasMips(): bool
    {
        return $this->mipMapCount > 0
            && $this->hasCapability(Capability::MIPMAP);
    }

    /**
     * @param Flag $flag
     * @return bool
     */
    public function hasFlag(Flag $flag): bool
    {
        return \in_array($flag, $this->flags, true);
    }

    /**
     * @param Capability $cap
     * @return bool
     */
    public function hasCapability(Capability $cap): bool
    {
        return \in_array($cap, $this->caps, true);
    }

    /**
     * @param Capability2 $cap2
     * @return bool
     */
    public function hasCapability2(Capability2 $cap2): bool
    {
        return \in_array($cap2, $this->caps2, true);
    }
}
