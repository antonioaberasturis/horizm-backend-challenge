<?php

declare(strict_types=1);

namespace Shared\SocialMedia\Services\Typicode\Resources;

use ReflectionObject;
use ReflectionProperty;
use Shared\SocialMedia\Services\Typicode\TypicodeClientInterface;

class ApiResource
{
    protected array $attributes = [];

    protected ?TypicodeClientInterface $client;

    public function __construct(array $attributes, TypicodeClientInterface $client = null)
    {
        $this->attributes = $attributes;

        $this->client = $client;

        $this->fill();

        unset($this->attributes);
    }

    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            if($this->existsProperty($key)) $this->{$key} = $value;
        }
    }

    public function __sleep()
    {
        $publicProperties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        $publicPropertyNames = array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $publicProperties);

        return array_diff($publicPropertyNames, ['client', 'attributes']);
    }

    protected function existsProperty(string $property)
    {
        $publicProperties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        $publicPropertyNames = array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $publicProperties);

        return in_array($property, $publicPropertyNames);
    }
}
