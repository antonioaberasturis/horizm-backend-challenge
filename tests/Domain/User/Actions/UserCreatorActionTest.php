<?php

declare(strict_types=1);

namespace Tests\Domain\User\Actions;

use Domain\User\User;
use Domain\User\Actions\UserCreatorAction;
use Tests\Domain\User\UserModuleUnitTestCase;
use Tests\Domain\User\Factories\UserSocialMediaDataFactory;

class UserCreatorActionTest extends UserModuleUnitTestCase
{
    private UserCreatorAction $creator;

    public function setUp(): void
    {
        parent::setUp();
        $this->creator = new UserCreatorAction(
            $this->userModel()
        );
    }

    public function testShouldInsertANewUser(): void
    {
        $userSocialMediaData = UserSocialMediaDataFactory::create();
        $user = User::factory()
                    ->id($userSocialMediaData->id)
                    ->externalId($userSocialMediaData->externalId)
                    ->name($userSocialMediaData->name)
                    ->email($userSocialMediaData->email)
                    ->city($userSocialMediaData->city)
                    ->make();

        $this->shouldMakeUserQueryBuilder();
        $this->shouldFindByExternalId($userSocialMediaData->externalId);
        $this->shouldFill(UserSocialMediaDataFactory::fromSelfAsArray($userSocialMediaData));
        $this->shouldSave(true);

        $this->userModel()
            ->shouldReceive('getAttributes')
            ->withNoArgs()
            ->once()
            ->andReturn($user->getAttributes());

        $response = $this->creator->__invoke($userSocialMediaData);

        $this->assertEquals($user->getAttributes(), $response->getAttributes());
    }

    public function testShouldNotInsertAnExistingUser(): void
    {
        $userSocialMediaData = UserSocialMediaDataFactory::create();
        $user = User::factory()
                    ->id($userSocialMediaData->id)
                    ->externalId($userSocialMediaData->externalId)
                    ->name($userSocialMediaData->name)
                    ->email($userSocialMediaData->email)
                    ->city($userSocialMediaData->city)
                    ->make();

        $this->shouldMakeUserQueryBuilder();
        $this->shouldFindByExternalId($userSocialMediaData->externalId, $user);

        $response = $this->creator->__invoke($userSocialMediaData);

        $this->assertNull($response);
    }
    
}
