<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Collection;

use ArrayIterator;
use InvalidArgumentException;
use Service\ContentManager\Domain\Entity\Entry;
use Service\ContentManager\Domain\Entity\EntryMeta;

class PostMetaCollection extends ArrayIterator
{
    public function append($value)
    {
        if (!$value instanceof EntryMeta) {
            throw new InvalidArgumentException("Invalid instance of " . EntryMeta::class);
        }

        parent::append($value);
    }

    public function toArray(): array
    {
        $returnArray = [];

        /** @var Entry $item */
        foreach($this as $item) {
            $returnArray[] = $item->toArray();
        }

        return $returnArray;
    }
}
