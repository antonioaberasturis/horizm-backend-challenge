<?php

declare(strict_types=1);

namespace Domain\User;

use Domain\Post\Post;
use Domain\User\Factory\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\User\Queries\UserQueryBuilder;
use Domain\User\Collections\UserCollection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'city',
        'rating',
        'top_post_id'
    ];

    public static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }

    public function top_post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'top_post_id');
    }

    public function getPost(): ?Post
    {
        return $this->relationLoaded('top_post') ? $this->getRelationValue('top_post') : null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
