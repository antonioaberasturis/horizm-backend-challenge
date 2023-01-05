<?php

declare(strict_types=1);

namespace Tests\Shared\SocialMedia;

use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;
use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;
use Shared\SocialMedia\Services\Typicode\Resources\PostCollection;
use Shared\SocialMedia\Services\Typicode\Resources\User;

abstract class SocialMediaModuleUnitTestCase extends TestCase
{
    private TypicodeClientInterface $typicodeService;

    protected function typicodeService(): MockInterface|TypicodeClientInterface
    {
        return $this->typicodeService = $this->typicodeService ?? $this->mock(TypicodeClientInterface::class);
    }

    protected function shouldGetPosts(PostCollection $return): void
    {
        $this->typicodeService()
            ->shouldReceive('posts')
            ->with(Mockery::type('int'), Mockery::type('int'))
            ->once()
            ->andReturn($return);
    }

    protected function shouldGetUser(int $id, User $return): void
    {
        $this->typicodeService()
            ->shouldReceive('user')
            ->with($id)
            ->once()
            ->andReturn($return);
    }
}
