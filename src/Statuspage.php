<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\Incident;
use Kartano\Statuspage\PageElements\Incidents;
use Kartano\Statuspage\PageElements\Page;

final class Statuspage
{
    public ?Page $page = null {
        get => $this->page;
    }

    public array $incidents = [] {
        get => $this->incidents;
    }

    public function __construct(string $rawJSON)
    {
        $decodedJSON = json_decode($rawJSON, true);
        $this->page = new Page($decodedJSON['page']);

        foreach ($decodedJSON['incidents'] as $incidentArray) {
            $incident = new Incident($incidentArray);
            $this->incidents[$incident->id] = &$incident;
        }
    }
}
