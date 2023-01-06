<?php

declare(strict_types=1);

namespace Tests\Domain\User\Actions;

use Domain\User\User;
use Tests\Domain\User\UserModuleUnitTestCase;
use Domain\User\Actions\UserFinderByExternalIdAction;

class UserFinderByExternalIdActionTest extends UserModuleUnitTestCase
{
    private UserFinderByExternalIdAction $finder;

    public function setUp(): void
    {
        parent::setUp();
        $this->finder = new UserFinderByExternalIdAction(
            $this->userModel()
        );
    }

    public function testShouldFindAnExistingUserByExternalId(): void
    {
        $user = User::factory()->make();

        $this->shouldMakeUserQueryBuilder();
        $this->shouldFindByExternalId($user->getExternalId(), $user);

        $response = $this->finder->__invoke($user->getExternalId());

        $this->assertEquals($user->getAttributes(), $response->getAttributes());
    }

    public function testShouldNotFindANotUserByExternalId(): void
    {
        $user = User::factory()->make();

        $this->shouldMakeUserQueryBuilder();
        $this->shouldFindByExternalId($user->getExternalId());

        $response = $this->finder->__invoke($user->getExternalId());

        $this->assertNull($response);
    }
}
