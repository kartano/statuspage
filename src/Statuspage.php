<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\Incident;
use Kartano\Statuspage\PageElements\Page;

final class Statuspage
{
    public ?Page $page = null {
        get => $this->page;
    }

    /** @var Incident[] $incidents */
    public array $incidents = [] {
        &get => $this->incidents;
    }

    /**
     * Build statuspage from a specific URL
     * @param string $URL URL to obtain incidents.json file from
     * @param int $timeout Timeout for URL connection - 30 seconds by default
     * @return Statuspage
     * @throws \InvalidArgumentException Timeout or URL in wrong format
     * @throws \RuntimeException Failed to retrieve data or CURL could not be initialized
     * @throws \JsonException Failed to decode the raw JSON string
     */
    public static function getFromURL(string $URL, int $timeout = 30): Statuspage
    {
        if (0 > $timeout) {
            throw new \InvalidArgumentException('Timeout must be great than 0');
        } elseif (filter_var($URL, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Invalid URL');
        }
        $handle = curl_init($URL);
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
        return static::getFromJSONString($response);
    }

    /**
     * Instantiate a statuspage using raw JSON
     * @param string $rawJSON
     * @return Statuspage
     * @throws \JsonException Failed to decode the raw JSON string
     */
    public static function getFromJSONString(string $rawJSON): Statuspage
    {
        $statuspage = new Statuspage();
        $decodedJSON = json_decode(json: $rawJSON, associative: true, flags: JSON_THROW_ON_ERROR);
        $statuspage->page = new Page($decodedJSON['page']);
        foreach ($decodedJSON['incidents'] as $incidentArray) {
            $incident = new Incident($incidentArray, $statuspage);
            $statuspage->incidents[$incident->id] = $incident;
        }

        return $statuspage;
    }
}
