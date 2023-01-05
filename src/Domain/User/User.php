<?php

declare(strict_types=1);

namespace Domain\User;

use Domain\Post\Post;
use Domain\User\Factory\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Domain\User\Queries\UserQueryBuilder;
use Domain\Post\Collections\PostCollection;
use Domain\User\Collections\UserCollection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'external_id',
        'name',
        'email',
        'city',
        'rating',
        'top_post_id'
    ];

    protected $casts = [
        'external_id' => 'string'
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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getPost(): ?Post
    {
        return $this->relationLoaded('top_post') ? $this->getRelationValue('top_post') : null;
    }

    public function getPosts(): ?PostCollection
    {
        return $this->relationLoaded('posts') ? $this->getRelationValue('posts') : null;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }
}
