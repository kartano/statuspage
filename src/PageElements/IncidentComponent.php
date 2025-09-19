<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

final class IncidentComponent
{
    public ?string $id = null {
        get => $this->id;
        set { $this->id = $value; }
    }

    public ?string $name = null {
        get => $this->name;
        set { $this->name = $value; }
    }

    public ?string $status = null {
        get => $this->status;
        set { $this->status = $value; }
    }

    public ?\DateTime $created_at = null {
        get => $this->created_at;
        set { $this->created_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }

    public ?\DateTime $updated_at = null {
        get => $this->updated_at;
        set { $this->updated_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }

    public ?int $position = null {
        get => $this->position;
        set { $this->position = $value; }
    }

    public ?string $description = null {
        get => $this->description;
        set { $this->description = $value; }
    }

    public ?bool $showcase = null {
        get => $this->showcase;
        set { $this->showcase = $value; }
    }

    public ?\DateTime $start_date = null {
        get => $this->start_date;
        set { $this->start_date = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }

    public ?string $group_id = null {
        get => $this->group_id;
        set { $this->group_id = $value; }
    }

    public ?bool $group = null {
        get => $this->group;
        set { $this->group = $value; }
    }

    public ?bool $only_show_if_degraded = null {
        get => $this->only_show_if_degraded;
        set { $this->only_show_if_degraded = $value; }
    }

    public ?Incident $parent_incident = null {
        get => $this->parent_incident;
        set { $this->parent_incident = $value; }
    }

    public function __construct(array $incidentComponent, Incident $parent)
    {
        $this->parent_incident = $parent;
        $this->id = $incidentComponent['id'];
        $this->name = $incidentComponent['name'];
        $this->status = $incidentComponent['status'];
        $this->created_at = $incidentComponent['created_at'];
        $this->updated_at = $incidentComponent['updated_at'] ?? null;
        $this->position = $incidentComponent['position'] ?? null;
        $this->description = $incidentComponent['description'] ?? null;
        $this->showcase = $incidentComponent['showcase'] ?? null;
        $this->start_date = $incidentComponent['start_date'] ?? null;
        $this->group_id = $incidentComponent['group_id'] ?? null;
        $this->group = $incidentComponent['group'] ?? null;
        $this->only_show_if_degraded = $incidentComponent['only_show_if_degraded'] ?? null;
    }
}
