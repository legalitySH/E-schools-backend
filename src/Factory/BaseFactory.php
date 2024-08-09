<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Api\FactoryInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class BaseFactory implements FactoryInterface
{
    public function __construct(private readonly ObjectNormalizer $normalizer)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function create(array $data)
    {
        return $this->normalizer->denormalize($data, $this->getObjectClassName());
    }

    public abstract function getObjectClassName(): string;
}
