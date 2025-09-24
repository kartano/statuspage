<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\Page;

final class Summary
{
    public ?Page $page = null {
        get => $this->page;
    }

    public string $indicator = '' {
        get => $this->indicator;
        set => $this->indicator = $value;
    }

    public string $description = '' {
        get => $this->description;
        set => $this->description = $value;
    }

    /**
     * Load status summary page via URL
     * @param string $url
     * @param int $timeout
     * @return Summary
     * @throws \JsonException
     */
    public static function getFromURL(string $url, int $timeout = 30): Summary
    {
        $rawtext = Util::loadFromURL($url, $timeout);
        return static::getFromJSONString($rawtext);
    }

    /**
     * Load summary page by raw json
     * @param string $rawJSON
     * @return Summary
     * @throws \JsonException
     */
    public static function getFromJSONString(string $rawJSON): Summary
    {
        $summary = new Summary();
        $decodedJSON = json_decode(json: $rawJSON, associative: true, flags: JSON_THROW_ON_ERROR);
        $summary->page = new Page($decodedJSON['page']);
        $summary->indicator = $decodedJSON['status']['indicator'];
        $summary->description = $decodedJSON['status']['description'];

        return $summary;
    }
}
