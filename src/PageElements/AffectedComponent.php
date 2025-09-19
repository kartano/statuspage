<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

final class AffectedComponent
{
    public ?string $code = null {
        get => $this->code;
        set { $this->code = $value; }
    }
    public ?string $name = null {
        get => $this->name;
        set { $this->name = $value; }
    }
    public ?string $old_status = null {
        get => $this->old_status;
        set { $this->old_status = $value; }
    }
    public ?string $new_status = null {
        get => $this->new_status;
        set { $this->new_status = $value; }
    }

    public ?IncidentUpdate $parent_incident_update = null {
        get => $this->parent_incident_update;
        set { $this->parent_incident_update = $value; }
    }

    public function __construct(array $affectedComponent, IncidentUpdate $parent)
    {
        $this->parent_incident_update = $parent;
        $this->code = $affectedComponent['code'];
        $this->name = $affectedComponent['name'];
        $this->old_status = $affectedComponent['old_status'];
        $this->new_status = $affectedComponent['new_status'];
    }
}
