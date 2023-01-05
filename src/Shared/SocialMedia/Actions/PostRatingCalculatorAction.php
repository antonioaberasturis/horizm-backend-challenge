<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Actions;

use Shared\SocialMedia\Services\Typicode\Resources\Post;

class PostRatingCalculatorAction
{
    public function __invoke(Post $post): float
    {
        $rating_count_based1 = str_word_count($post->body);
        $rating_count_based2 = str_word_count($post->title);
        $rating_count        =  $rating_count_based1 + $rating_count_based2;

        $point_count_based1 = $rating_count_based1 * 1;
        $point_count_based2 = $rating_count_based2 * 2;
        $point_count        = $point_count_based1 + $point_count_based2;
        
        if($rating_count === 0) return 0.00;
        
        return round($point_count / $rating_count , 2);
    }
}
