<?php
declare(strict_types=1);

namespace Service\PostManager\Domain\Collection;

use ArrayIterator;
use InvalidArgumentException;
use Service\PostManager\Domain\Entity\Post;

class PostCollection extends ArrayIterator
{
    public function append($value)
    {
        if (!$value instanceof Post) {
            throw new InvalidArgumentException("Invalid instance of " . Post::class);
        }

        parent::append($value);
    }
}
