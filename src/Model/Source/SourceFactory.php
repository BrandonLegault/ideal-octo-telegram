<?php

namespace IdealOctoTelegram\Model\Source;

use IdealOctoTelegram\Model\Source\SourceInterface;
use IdealOctoTelegram\Model\Source\Sources\ArraySource;
use IdealOctoTelegram\Model\Source\Sources\JsonSource;
use IdealOctoTelegram\Model\Source\Sources\FileSource;
use IdealOctoTelegram\Exception\IdealOctoTelegramException;

class SourceFactory
{
    /**
     * @throws IdealOctoTelegramException if $source doesn't match a known type
     * 
     * @param string $source 'array', 'json', 'file'
     * @param mixed $args arguments to be passed to source constructor
     * 
     * @return SourceInterface
     */
    public static function createFromTypeString(string $source, string $entityClass, ?string $filename): SourceInterface
    {
        return match($source) {
            'array' => ArraySource::getInstance($entityClass),
            'json' => JsonSource::getInstance($entityClass),
            'file' => FileSource::getInstance($filename, $entityClass),
            default => throw new IdealOctoTelegramException('Unknown source')
        };
    }
}