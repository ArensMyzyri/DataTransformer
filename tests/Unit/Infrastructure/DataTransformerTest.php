<?php

namespace App\Tests\Unit\Infrastructure;

use App\Domain\DataTransformerInterface;
use App\Infrastructure\DataTransformer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DataTransformerTest extends TestCase
{
    private SerializerInterface $serializer;
    private NormalizerInterface $normalizer;
    private DataTransformerInterface $dataTransformer;
    protected function setUp(): void
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->normalizer = $this->createMock(NormalizerInterface::class);
        $this->dataTransformer = new DataTransformer($this->serializer, $this->normalizer);
    }

    protected function tearDown(): void
    {
        $this->serializer;
        $this->normalizer;
        $this->dataTransformer;
    }

    #[test]
    public function ModelToModelTransformationTest(): void
    {
        $model1 = new TestModel1('stringData', 1234, ['key' => 'value']);
        $modelResult = $this->dataTransformer->transformModelToModel($model1, TestModel2::class);

        $this->assertEquals($model1->someArray, $modelResult->someArray);
        $this->assertEquals($model1->someString, $modelResult->someString);
        $this->assertEquals($model1->someInt, $modelResult->someInt);
    }

    #[test]
    public function ArrayToModelTransformationTest(): void
    {
        $dataArray = ['someArray' => ['key' => 'value'], 'someString' => 'stringData', 'someInt' => 123];
        $modelResult = $this->dataTransformer->transformArrayToModel($dataArray, TestModel2::class);

        $this->assertEquals($dataArray['someArray'], $modelResult->someArray);
        $this->assertEquals($dataArray['someString'], $modelResult->someString);
        $this->assertEquals($dataArray['someInt'], $modelResult->someInt);
    }

    #[test]
    public function ModelToArrayTransformationTest(): void
    {
        $model1 = new TestModel1('stringData', 1234, ['key' => 'value']);
        $dataArray = ['someString' => 'stringData', 'someInt' => 1234, 'someArray' => ['key' => 'value']];

        $modelResult = $this->dataTransformer->transformModelToArray($model1);
        $this->assertEquals($modelResult, $dataArray);
    }

    #[test]
    public function JsonToModelTransformationTest(): void
    {
        $dataArray = ['someArray' => ['key' => 'value'], 'someString' => 'stringData', 'someInt' => 123];

        /** @var TestModel2 $modelResult */
        $modelResult = $this->dataTransformer->transformJsonToModel(json_encode($dataArray, true), TestModel2::class);

        $this->assertEquals($dataArray['someArray'], $modelResult->someArray);
        $this->assertEquals($dataArray['someString'], $modelResult->someString);
        $this->assertEquals($dataArray['someInt'], $modelResult->someInt);
    }
}
