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

    /**
     * Wrapper to grab data using cURL and supply exceptions on failure
     * @param string $url
     * @param int $timeout
     * @return string
     */
    public static function loadFromURL(string $url, int $timeout = 30): string
    {
        if (0 > $timeout) {
            throw new \InvalidArgumentException('Timeout must be great than 0');
        } elseif (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Invalid URL');
        }
        $handle = curl_init($url);
        if (false === $handle) {
            throw new \RuntimeException('Failed to initialize cURL');
        }
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($handle, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $response = curl_exec($handle);
        if (false === $response) {
            throw new \RuntimeException(curl_error($handle), curl_errno($handle));
        }
        curl_close($handle);
        return $response;
    }
}
