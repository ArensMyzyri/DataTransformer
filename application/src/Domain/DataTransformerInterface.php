<?php

namespace App\Domain;

interface DataTransformerInterface
{
    public function transformModelToModel(object $model1, string $model2): object;

    public function transformModelToArray(object $model): array;

    public function transformArrayToModel(array $jsonData, string $model): object;

    public function transformJsonToModel(string $jsonData, string $model): object;

    public function transformModelToJson(object $model): ?string;

    public function transformModelToXml(string $xmlData, string $model): object;

    public function transformXmlToModel(object $model): ?string;
}
