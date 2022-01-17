<?php

namespace IdealOctoTelegram\Model\Entity;

use IdealOctoTelegram\Model\Entity\EntityInterface;

class Player implements EntityInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $job,
        public readonly string $salary,
        public readonly int $age
    ) {}
}