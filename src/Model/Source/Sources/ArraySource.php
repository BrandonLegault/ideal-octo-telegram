<?php

namespace IdealOctoTelegram\Model\Source\Sources;

use IdealOctoTelegram\Model\Entity\EntityInterface;
use IdealOctoTelegram\Model\Source\SourceInterface;
use IdealOctoTelegram\Model\Source\AbstractSource;
use stdClass;

class ArraySource extends AbstractSource implements SourceInterface
{
    protected array $array = [];

    public const TYPE = 'array';

    /**
     * @inheritdoc
     */
    public function read(): iterable
    {
        return $this->array;
    }

    /**
     * @inheritdoc
     */
    public function write(EntityInterface|stdClass $entity): iterable
    {
        $this->array[] = $entity;

        return $this->array;
    }
}