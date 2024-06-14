<?php

namespace Billbee\ForeignSystemsSdk\Common\Helper;

use DateTimeInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Handler\DateHandler;
use JMS\Serializer\Handler\EnumHandler;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Visitor\Factory\JsonSerializationVisitorFactory;

class JsonSerializer
{
    public static function serialize(
        mixed                 $data,
        ?SerializationContext $context = null,
        ?string               $type = null
    ): string {
        return self::getSerializer()->serialize($data, 'json', $context, $type);
    }


    /**
     * @template T
     * @param string $data
     * @param class-string<T> $type
     * @param DeserializationContext|null $context
     * @return T
     */
    public static function deserialize(string $data, string $type, ?DeserializationContext $context = null): mixed
    {
        return self::getSerializer()->deserialize($data, $type, 'json', $context);
    }

    private static function getSerializer(): Serializer
    {
        $factory = new JsonSerializationVisitorFactory();
        $factory->setOptions(0);
        $builder = SerializerBuilder::create()
            ->setSerializationVisitor('json', $factory);

        return $builder
            ->configureHandlers(function (HandlerRegistryInterface $handlerRegistry) {
                $handlerRegistry->registerSubscribingHandler(new DateHandler(DateTimeInterface::ATOM));
                $handlerRegistry->registerSubscribingHandler(new EnumHandler());
            })
            ->build();
    }

}
