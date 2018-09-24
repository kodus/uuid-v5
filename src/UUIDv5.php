<?php

namespace Kodus\Helpers;

use InvalidArgumentException;

/**
 * This helper generates namespace-based version 5 UUIDs
 *
 * @link https://en.wikipedia.org/wiki/Universally_unique_identifier
 */
class UUIDv5
{
    const NS_DNS = "6ba7b810-9dad-11d1-80b4-00c04fd430c8";
    const NS_URL = "6ba7b811-9dad-11d1-80b4-00c04fd430c8";
    const NS_OID = "6ba7b812-9dad-11d1-80b4-00c04fd430c8";
    const NS_X500 = "6ba7b814-9dad-11d1-80b4-00c04fd430c8";

    const UUID_V5_PATTERN = '/^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

    const UUID_FORMAT = '%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x-%02x%02x%02x%02x%02x%02x';

    public static function create(string $namespace_uuid, string $name): string
    {
        $namespace = @pack('H*', str_replace('-', '', $namespace_uuid));

        if (strlen($namespace) !== 16) {
            throw new InvalidArgumentException("invalid namespace UUID");
        }

        $bytes = unpack('C*', sha1($namespace . $name, true));

        return sprintf(self::UUID_FORMAT,
            $bytes[1], $bytes[2], $bytes[3], $bytes[4],
            $bytes[5], $bytes[6],
            $bytes[7] & 0x0f | 0x50, $bytes[8],
            $bytes[9] & 0x3f | 0x80, $bytes[10],
            $bytes[11], $bytes[12], $bytes[13], $bytes[14], $bytes[15], $bytes[16]
        );
    }

    /**
     * Validates a given string as UUID v5
     *
     * @return bool TRUE, if the given string is a valid UUID v5 identifier
     */
    public static function isValid(string $uuid): bool
    {
        return preg_match(self::UUID_V5_PATTERN, $uuid) === 1;
    }
}
