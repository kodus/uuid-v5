<?php

namespace Kodus\Test\Unit;

use InvalidArgumentException;
use Kodus\Helpers\UUIDv5;
use UnitTester;

class UUIDv5Cest
{
    public function validateUUID_v5(UnitTester $I)
    {
        $I->assertTrue(UUIDv5::isValid("0a300ee9-f9e4-5697-a51a-efc7fafaba67"));
        $I->assertTrue(UUIDv5::isValid("0A300EE9-F9E4-5697-A51A-EFC7FAFABA67"));

        $I->assertFalse(UUIDv5::isValid("a300ee9-f9e4-5697-a51a-efc7fafaba67")); // missing first
        $I->assertFalse(UUIDv5::isValid("0a300ee9-f9e4-5697-a51a-efc7fafaba6")); // missing last
        $I->assertFalse(UUIDv5::isValid("0a300ee9-f9e4-a51a-efc7fafaba67")); // missing group
        $I->assertFalse(UUIDv5::isValid("0a300ee9-f9e4-5697-a51a-efc7fafaba671")); // junk at end
        $I->assertFalse(UUIDv5::isValid("10a300ee9-f9e4-5697-a51a-efc7fafaba67")); // junk at start
        $I->assertFalse(UUIDv5::isValid("5be01114-2bee-11e7-93ae-92361f002671")); // UUID v1
        $I->assertFalse(UUIDv5::isValid("afbc8a93-ebc4-41cc-9204-bb52a7534a55")); // UUID v4
        $I->assertFalse(UUIDv5::isValid("0a300ee9f9e45697a51aefc7fafaba67")); // missing dashes
    }

    public function createNamespacedUUID(UnitTester $I)
    {
        $uuid = UUIDv5::create(UUIDv5::NS_URL, "http://example.com/");

        $I->assertTrue(UUIDv5::isValid($uuid));

        $I->assertSame("0a300ee9-f9e4-5697-a51a-efc7fafaba67", $uuid);

        $I->expectException(InvalidArgumentException::class, function () {
            UUIDv5::create("not-a-valid-uuid-obvs", "http://example.com/");
        });
    }
}
