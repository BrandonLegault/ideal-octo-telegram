<?php

namespace IdealOctoTelegram\Model\Source;

use IdealOctoTelegram\Model\Entity\EntityInterface;
use stdClass;

interface SourceInterface
{
    /**
     * @return EntityInterface[]
     */
    public function read(): iterable;

    /**
     * @param EntityInterface $entity
     * @return EntityInterface[]
     */
    public function write(EntityInterface|stdClass $entity): iterable;

    /**
     * @param EntityInterface[]
     * 
     * @return string]
     */
    public function serialize(iterable $json): string;

    /**
     * @return EntityInterface[]
     */
    public function deserialize(string $json): iterable;
}