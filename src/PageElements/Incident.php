<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

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
        set { $this->created_at = $value; }
    }
    public ?\DateTime $updated_at = null {
        get => $this->updated_at;
        set { $this->updated_at = $value; }
    }
    public ?\DateTime $monitoring_at = null {
        get => $this->monitoring_at;
        set { $this->monitoring_at = $value; }
    }
    public ?\DateTime $resolved_at = null {
        get => $this->resolved_at;
        set { $this->resolved_at = $value; }
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
        set { $this->started_at = $value; }
    }

    public array $incident_updates = [] {
        get => $this->incident_updates;
    }

    public function __construct(array $incident)
    {
        $this->id = $incident['id'];
        $this->name = $incident['name'];
        $this->status = $incident['status'];
        $this->created_at = new \DateTime($incident['created_at']) ?? null;
        $this->updated_at = new \DateTime($incident['updated_at']) ?? null;
        $this->monitoring_at = $incident['monitoring_at'];
        $this->resolved_at = new \DateTime($incident['resolved_at']) ?? null;
        $this->impact = $incident['impact'];
        $this->shortlink = $incident['shortlink'];
        $this->started_at = new \DateTime($incident['started_at']) ?? null;

        foreach ($incident['incident_updates'] as $update) {
            $incidentUpdate = new IncidentUpdate($update);
            $this->incident_updates[$incidentUpdate->id] = &$incidentUpdate;
        }
    }
}
