<?php

declare(strict_types=1);

namespace Domain\Post\Collections;

use Illuminate\Database\Eloquent\Collection;

class PostCollection extends Collection
{
    public function totalSumRating(): int
    {
        return $this->sum('rating');
    }
}
