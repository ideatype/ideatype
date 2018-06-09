<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Collection;

use ArrayIterator;
use InvalidArgumentException;
use Service\PostManager\Domain\Entity\Post;
use Service\PostManager\Domain\Entity\PostMeta;

class PostMetaCollection extends ArrayIterator
{
    public function append($value)
    {
        if (!$value instanceof PostMeta) {
            throw new InvalidArgumentException("Invalid instance of " . PostMeta::class);
        }

        parent::append($value);
    }

    public function toArray(): array
    {
        $returnArray = [];

        /** @var Post $item */
        foreach($this as $item) {
            $returnArray[] = $item->toArray();
        }

        return $returnArray;
    }
}
