<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Resources;

use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;

class User extends ApiResource
{
    public int $id;
    public string $name;
    public string $username;
    public string $email;
    public string $city;
    public $address;

    public function __construct(array $attributes, TypicodeClientInterface $client = null)
    {
        parent::__construct($attributes, $client);
        
        $this->address = new UserAddress($attributes['address'], $client);
    }
}
