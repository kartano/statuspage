<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\IncidentComponent;
use Kartano\Statuspage\PageElements\Page;

final class Components implements \Countable
{
    public ?Page $page = null {
        get => $this->page;
    }

    public array $components = [] {
        & get=> $this->components;
    }

    /**
     * Load status summary page via URL
     * @param string $url
     * @param int $timeout
     * @return Summary
     * @throws \JsonException
     */
    public static function getFromURL(string $url, int $timeout = 30): Components
    {
        $rawtext = Util::loadFromURL($url, $timeout);
        return static::getFromJSONString($rawtext);
    }

    /**
     * Load Components page by raw json
     * @param string $rawJSON
     * @return Components
     * @throws \JsonException
     */
    public static function getFromJSONString(string $rawJSON): Components
    {
        $components = new Components();
        $decodedJSON = json_decode(json: $rawJSON, associative: true, flags: JSON_THROW_ON_ERROR);
        $components->page = new Page($decodedJSON['page']);

        foreach ($decodedJSON['components'] as $component) {
            $incidentComponent = new IncidentComponent($component);
            $components->components[] = $incidentComponent;
        }

        return $components;
    }

    public function count(): int
    {
        return count($this->components);
    }
}
