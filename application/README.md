Data transformer and serializer
========================

This is a simple though powerful transformer that helps you with normalizing and serializing models, json, array and so on.


Requirements
------------

* PHP 8.1 or higher;
* Symfony 6.2 or higher;
* Symfony Serializer

Installation
------------

```bash
composer require ArensMyzyri/data-transformation-and-serializer
```

Usage
-----

There's no need to configure anything before running the application.

You can inject the interface in the constructor like: 

```bash
public function __construct(
  private DataTransformerInterface $dataTransformer
) { }
```

Then simple call the method you want to use:

```bash
$this->dataTransformer->transformModelToJson($model);
$this->dataTransformer->transformJsonToModel($jsonData, Model::class);
$this->dataTransformer->transformArrayToModel($arrayData, Model::class);
```

Tests
-----

Execute this command to run tests in the root of the project:

```bash
./vendor/bin/phpunit
```

License
-----

Copyright (c) 2024 Arens Myzyri

MIT. 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
