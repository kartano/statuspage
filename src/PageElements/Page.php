<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

final class Page
{
    public ?string $id = null {
        get => $this->id;
        set { $this->id = $value; }
    }

    public ?string $name = null {
        get => $this->name;
        set { $this->name = $value; }
    }

    public ?string $url = null {
        get => $this->url;
        set { $this->url = $value; }
    }

    public ?\DateTimeZone $time_zone = null {
        get => $this->time_zone;
        set { $this->time_zone = $value; }
    }

    public ?\DateTime $updated_at {
        get => $this->updated_at;
        set { $this->updated_at = $value; }
    }

    public function __construct(array $page)
    {
        $this->id = $page['id'];
        $this->name = $page['name'];
        $this->url = $page['url'];
        $this->time_zone = new \DateTimeZone($page['time_zone']);
        $this->updated_at = $page['updated_at'] ?? null;
    }
}
