<?php

namespace IdealOctoTelegram\Model\Source\Sources;

use IdealOctoTelegram\Model\Entity\EntityInterface;
use IdealOctoTelegram\Model\Source\SourceInterface;
use IdealOctoTelegram\Model\Source\AbstractSource;
use stdClass;

class FileSource extends AbstractSource implements SourceInterface 
{
    public const TYPE = 'file';

    /**
     * FileSource doesn't need to be a singleton
     */
    public static function getInstance(...$args)
    {
        return new static(...$args);
    }

    protected function __construct(
        protected string $filename,
        ...$args
    ) {
        parent::__construct(...$args);
    }

    /**
     * @inheritdoc
     */
    public function read(): iterable
    {
        $json = file_get_contents($this->filename);

        return $this->deserialize($json);
    }

    /**
     * @inheritdoc
     */
    public function write(EntityInterface|stdClass $entity): iterable
    {
        $contents = $this->read();
        $contents[] = $entity;
        
        file_put_contents($this->filename, $this->serialize($contents));

        return $contents;
    }
}