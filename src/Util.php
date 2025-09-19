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
}
