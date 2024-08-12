<?php

namespace App\Infrastructure;

use App\Domain\DataTransformerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class DataTransformer implements DataTransformerInterface
{
    public function __construct(
        private SerializerInterface $serializer
    ) {
        $encoders = ['json' => new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer(), new JsonSerializableNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    // Model to needs to be the name of the model example: Model::class from the caller of this method
    public function transformModelToModel(object $model1, string $model2): object
    {
        return $this->serializer->deserialize($this->serializer->serialize($model1, 'json'), $model2, 'json');
    }

    /**
     * @throws ExceptionInterface
     */
    public function transformModelToArray(object $model): array
    {
        return $this->serializer->normalize($model);
    }

    /**
     * @throws \JsonException
     */
    public function transformArrayToModel(array $jsonData, string $model): object
    {
        return $this->serializer->deserialize(json_encode($jsonData, JSON_THROW_ON_ERROR | true), $model, 'json');
    }

    /**
     * @throws \JsonException
     */
    public function transformJsonToModel(string $jsonData, string $model): object
    {
        json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);

        return $this->serializer->deserialize($jsonData, $model, 'json');
    }

    public function transformModelToJson(object $model): ?string
    {
        return $this->serializer->serialize($model, 'json');
    }

    public function transformModelToXml(string $xmlData, string $model): object
    {
        return $this->serializer->deserialize($xmlData, $model, 'xml');
    }

    public function transformXmlToModel(object $model): ?string
    {
        return $this->serializer->serialize($model, 'xml');
    }
}
