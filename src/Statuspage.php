<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\AffectedComponent;
use Kartano\Statuspage\PageElements\Incident;
use Kartano\Statuspage\PageElements\Page;

final class Statuspage implements \Countable
{
    public ?Page $page = null {
        get => $this->page;
    }

    /** @var Incident[] $incidents */
    public array $incidents = [] {
        & get => $this->incidents;
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
    public static function getFromURL(string $url, int $timeout = 30): Statuspage
    {
        $rawtext = Util::loadFromURL($url, $timeout);
        return static::getFromJSONString($rawtext);
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

    /**
     * @param string $filter
     * @param bool $isRegex
     * @return AffectedComponent[]
     */
    public function getComponents(string $filter, bool $isRegex = false): array
    {
        $results = [];
        foreach ($this->incidents as $incident) {
            foreach ($incident->incident_updates as $incidentUpdate) {
                /** @var AffectedComponent $affectedComponent */
                foreach ($incidentUpdate->affected_components as $affectedComponent) {
                    if ($isRegex) {
                        if (preg_match($filter, $affectedComponent->name)) {
                            $results[$affectedComponent->code] = $affectedComponent->toArray();
                        }
                    } else {
                        if (mb_strtoupper($affectedComponent->name) === mb_strtoupper($filter)) {
                            $results[$affectedComponent->code] = $affectedComponent->toArray();
                        }
                    }
                }
            }
        }
        return $results;
    }

    public function count(): int
    {
        return count($this->incidents);
    }
}
