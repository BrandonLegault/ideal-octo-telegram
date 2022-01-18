<?php

namespace IdealOctoTelegram\Model\Source;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use IdealOctoTelegram\Model\Source\SourceInterface;
use stdClass;

abstract class AbstractSource implements SourceInterface
{
    protected static $instance;

    /**
     * In-memory sources like 'array' and 'json' will need to be singletons
     *  in order to preserve original PlayersObject behaviour
     */
    public static function getInstance(...$args)
    {
        if (self::$instance === null) {
            self::$instance = new static(...$args);
        }

        return self::$instance;
    }
    
    protected function __construct(
        protected string $entityClass
    ) {}
    
    /**
     * @inheritdoc
     */
    public function serialize(iterable $objects): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        
        return $serializer->serialize($objects, 'json');
    }

    /**
     * @inheritdoc
     */
    public function deserialize(string $json): iterable
    {
        // Symfony serializer seems have to issues with stdClass :(
        if ($this->entityClass === stdClass::class) {
            return json_decode($json);
        }

        $serializer = new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        return $serializer->deserialize($json, $this->entityClass.'[]', 'json');
    }
}