<?php

declare(strict_types=1);

namespace Domain\Post;

use Domain\User\User;
use Domain\Post\Factory\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\Post\Queries\PostQueryBuilder;
use Domain\Post\Collections\PostCollection;
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
        'external_id',
        'user_id',
        'title',
        'body',
        'rating',
    ];

    protected $casts = [
        'rating' => 'int',
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

    public function newCollection(array $models = []): PostCollection
    {
        return new PostCollection($models);
    }

    public function getUser(): ?User
    {
        return $this->relationLoaded('user') ? $this->getRelationValue('user'): null;
    }

    public function newBody(string $body): void
    {
        $this->body = $body;
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

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }
}
