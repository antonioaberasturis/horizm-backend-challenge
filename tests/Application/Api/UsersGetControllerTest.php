<?php

declare(strict_types=1);

namespace Tests\Application\Api;

use Illuminate\Testing\Assert;
use Tests\Application\ApiApplicationAcceptanceTestCase;
use Tests\Application\Api\Factories\UsersGetControllerResponseFactory;

class UsersGetControllerTest extends ApiApplicationAcceptanceTestCase
{
    public function testShouldGetUsersWithPosts(): void
    {
        $users = UsersGetControllerResponseFactory::create();

        $response = $this->get("api/users");

        $response->assertStatus(200);
        
        $contents = json_decode($response->getContent(), true) ;
        
        foreach($contents as $user){
            $expectedUser = $users->shift();
            Assert::assertTrue($user['id'] === $expectedUser->getId());
            Assert::assertTrue($user['posts'][0]['user_id'] === $expectedUser->getId());
        }
    }
}
