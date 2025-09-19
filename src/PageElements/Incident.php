<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

use Kartano\Statuspage\Statuspage;

final class Incident
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
    public ?\DateTime $monitoring_at = null {
        get => $this->monitoring_at;
        set { $this->monitoring_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }
    public ?\DateTime $resolved_at = null {
        get => $this->resolved_at;
        set { $this->resolved_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }
    public string $impact = 'none' {
        get => $this->impact;
        set { $this->impact = $value; }
    }
    public ?string $shortlink = null {
        get => $this->shortlink;
        set { $this->shortlink = $value; }
    }
    public ?\DateTime $started_at = null {
        get => $this->started_at;
        set { $this->started_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }

    public array $incident_updates = [] {
        &get => $this->incident_updates;
    }

    public array $components = [] {
        &get => $this->components;
    }

    public ?string $reminder_intervals = null {
        get => $this->reminder_intervals;
        set { $this->reminder_intervals = $value; }
    }

    public ?Statuspage $parent_statuspage = null {
        get => $this->parent_statuspage;
        set { $this->parent_statuspage = $value; }
    }

    public function __construct(array $incident, Statuspage $parent)
    {
        $this->parent_statuspage = $parent;
        $this->id = $incident['id'];
        $this->name = $incident['name'];
        $this->status = $incident['status'];
        $this->created_at = $incident['created_at'] ?? null;
        $this->updated_at = $incident['updated_at'] ?? null;
        $this->monitoring_at = $incident['monitoring_at'];
        $this->resolved_at = $incident['resolved_at'] ?? null;
        $this->impact = $incident['impact'];
        $this->shortlink = $incident['shortlink'];
        $this->started_at = $incident['started_at'] ?? null;

        foreach ($incident['incident_updates'] as $update) {
            $incidentUpdate = new IncidentUpdate($update, $this);
            $this->incident_updates[$incidentUpdate->id] = $incidentUpdate;
        }

        foreach ($incident['components'] as $component) {
            $incidentComponent = new IncidentComponent($component, $this);
            $this->components[$incidentComponent->id] = $incidentComponent;
        }

        $this->reminder_intervals = $incident['reminder_intervals'] ?? null;
    }
}
