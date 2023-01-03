<?php

declare(strict_types=1);

namespace Domain\Post;

use Domain\User\User;
use Domain\Post\Factory\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\Post\Queries\PostQueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
        'rating',
    ];

    public static function newFactory(): PostFactory
    {
        return new PostFactory();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newEloquentBuilder($query): PostQueryBuilder
    {
        return new PostQueryBuilder($query);
    }

    public function getUser(): ?User
    {
        return $this->relationLoaded('user') ? $this->getRelationValue('user'): null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
