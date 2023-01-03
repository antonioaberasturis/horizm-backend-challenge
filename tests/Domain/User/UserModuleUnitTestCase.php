<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use Domain\User\User;
use Mockery\MockInterface;
use Tests\Shared\UnitTestCase;
use Domain\User\Queries\UserQueryBuilder;
use Domain\User\Collections\UserCollection;

abstract class UserModuleUnitTestCase extends UnitTestCase
{
    protected User $user;
    protected UserQueryBuilder $queryBuilder;

    protected function userModel(): MockInterface|User
    {
        return $this->user = $this->user ?? $this->mock(User::class);
    }

    protected function userQueryBuilder(): MockInterface|UserQueryBuilder
    {
        return $this->queryBuilder = $this->queryBuilder ?? $this->mock(UserQueryBuilder::class);
    }

    public function shouldSearchUserWithPostTop(UserCollection $return): void
    {
        $this->userQueryBuilder()
            ->shouldReceive('searchAllUsersWithPostTop')
            ->withNoArgs()
            ->once()
            ->andReturn($return);
        $this->userModel()
            ->shouldReceive('query')
            ->withNoArgs()
            ->andReturn($this->userQueryBuilder());
    }
}
