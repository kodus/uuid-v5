kodus/uuid-v5
=============

Simple static UUID v5 generator/validator.

[![PHP Version](https://img.shields.io/badge/php-7.0%2B-blue.svg)](https://packagist.org/packages/kodus/uuid-v4)

## Usage

Create and validate formatted UUID v5:

```php
use Kodus\Helpers\UUID;

$uuid = UUIDv5::create(UUIDv5::NS_URL, "http://example.com/"); // "0a300ee9-f9e4-5697-a51a-efc7fafaba67"

assert(UUIDv5::isValid($uuid));
```

Constants are available for the predefined namespaces defined in
[RFC4122 appendix C](https://tools.ietf.org/html/rfc4122#appendix-C).
