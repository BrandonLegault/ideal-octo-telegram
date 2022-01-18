<?php

namespace IdealOctoTelegram\Model\Source\Sources;

use IdealOctoTelegram\Model\Entity\EntityInterface;
use IdealOctoTelegram\Model\Source\SourceInterface;
use IdealOctoTelegram\Model\Source\AbstractSource;
use stdClass;

class JsonSource extends AbstractSource implements SourceInterface
{
    protected string $json = '[]';

    public const TYPE = 'json';

    /**
     * @inheritdoc
     */
    public function read(): iterable
    {
        return $this->deserialize($this->json);
    }

    /**
     * @inheritdoc
     */
    public function write(EntityInterface|stdClass $entity): iterable
    {
        $entities = $this->read();
        $entities[] = $entity;

        $this->json = $this->serialize($entities);

        return $entities;
    }

}