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
    protected Post $postExisting;
    protected PostQueryBuilder $queryBuilder;

    protected function postModel(): MockInterface|Post
    {
        return $this->post = $this->post ?? $this->mock(Post::class);
    }

    protected function postModelExisting(): MockInterface|Post
    {
        return $this->postExisting = $this->postExisting ?? $this->mock(Post::class);
    }

    protected function postQueryBuilder(): MockInterface|PostQueryBuilder
    {
        return $this->queryBuilder = $this->queryBuilder ?? $this->mock(PostQueryBuilder::class);
    }

    public function shouldMakePostQueryBuilder(): void
    {
        $this->postModel()
        ->shouldReceive('query')
        ->withNoArgs()
        ->andReturn($this->postQueryBuilder());
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

    protected function shouldFindByExternalId(string $id, ?Post $return = null): void
    {
        $this->postQueryBuilder()
            ->shouldReceive('findByExternalId')
            ->with($id)
            ->once()
            ->andReturn($return);
    }

    protected function shouldFill(array $datas): void
    {
        $this->postModel()
            ->shouldReceive('fill')
            ->with($datas)
            ->once()
            ->andReturnNull();
    }

    protected function shouldUpdateBody(string $body): void
    {
        $this->postModelExisting()
            ->shouldReceive('updateBody')
            ->with($body)
            ->once()
            ->andReturnNull();
    }

    protected function shouldSave(bool $return): void
    {
        $this->postModel()
            ->shouldReceive('save')
            ->withNoArgs()
            ->once()
            ->andReturn($return);
    }
}
