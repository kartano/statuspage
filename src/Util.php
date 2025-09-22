<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

final class Util
{
    public static function safeDateTime(string|\DateTime|null $value): ?\DateTime
    {
        if ($value instanceof \DateTime) {
            return $value;
        } elseif (is_null($value)) {
            return null;
        } else {
            return new \DateTime($value);
        }
    }

    public static function assertValidID(string $id): string
    {
        if (preg_match('/^[a-z0-9]{12}$/', $id)) {
            return $id;
        } else {
            throw new \InvalidArgumentException('ID ' . $id . ' is not valid.');
        }
    }
}
