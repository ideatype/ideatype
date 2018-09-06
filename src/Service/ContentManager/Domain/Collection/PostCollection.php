<?php
declare(strict_types=1);

namespace Service\ContentManager\Domain\Collection;

use ArrayIterator;
use InvalidArgumentException;
use Service\ContentManager\Domain\Entity\Entry;

class PostCollection extends ArrayIterator
{
    public function append($value)
    {
        if (!$value instanceof Entry) {
            throw new InvalidArgumentException("Invalid instance of " . Entry::class);
        }

        parent::append($value);
    }
}
