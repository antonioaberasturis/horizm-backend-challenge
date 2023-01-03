<?php

declare(strict_types=1);

namespace Tests\Domain\Post;

use Domain\Post\Post;
use Mockery\MockInterface;
use Tests\Shared\UnitTestCase;
use Domain\Post\Queries\PostQueryBuilder;

abstract class PostModuleUnitTestCase extends UnitTestCase
{
    protected Post $post;
    protected PostQueryBuilder $queryBuilder;

    protected function postModel(): MockInterface|Post
    {
        return $this->post = $this->post ?? $this->mock(Post::class);
    }

    protected function postQueryBuilder(): MockInterface|PostQueryBuilder
    {
        return $this->queryBuilder = $this->queryBuilder ?? $this->mock(PostQueryBuilder::class);
    }

    public function shouldFindWithUser(string $id, ?Post $return = null): void
    {
        $this->postQueryBuilder()
            ->shouldReceive('findWithUser')
            ->with($id)
            ->once()
            ->andReturn($return);
        $this->postModel()
            ->shouldReceive('query')
            ->withNoArgs()
            ->andReturn($this->postQueryBuilder());
    }
}
