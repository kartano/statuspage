<?php

declare(strict_types=1);

namespace Kartano\Statuspage\PageElements;

final class IncidentUpdate
{
    public ?string $id = null {
        get => $this->id;
        set { $this->id = $value; }
    }
    public ?string $status = null {
        get => $this->status;
        set { $this->status = $value; }
    }
    public ?string $body = null {
        get => $this->body;
        set { $this->body = $value; }
    }
    public ?\DateTime $created_at = null {
        get => $this->created_at;
        set { $this->created_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }
    public ?\DateTime $updated_at = null {
        get => $this->updated_at;
        set { $this->updated_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }
    public ?\DateTime $display_at = null {
        get => $this->display_at;
        set { $this->display_at = $value instanceof \DateTime ? $value : new \DateTime($value); }
    }
    public ?bool $deliver_notifications = null {
        get => $this->deliver_notifications;
        set { $this->deliver_notifications = $value; }
    }
    public ?string $custom_tweet = null {
        get => $this->custom_tweet;
        set { $this->custom_tweet = $value; }
    }
    public ?string $tweet_id = null {
        get => $this->tweet_id;
        set { $this->tweet_id = $value; }
    }

    public array $affected_components = [] {
        &get => $this->affected_components;
    }

    public ?Incident $parent_incident = null {
        get => $this->parent_incident;
        set { $this->parent_incident = $value; }
    }

    public function __construct(array $incidentUpdate, Incident $parent)
    {
        $this->parent_incident = $parent;
        $this->id = $incidentUpdate['id'];
        $this->status = $incidentUpdate['status'];
        $this->body = $incidentUpdate['body'];
        $this->created_at = $incidentUpdate['created_at'] ?? null;
        $this->updated_at = $incidentUpdate['updated_at'] ?? null;
        $this->display_at = $incidentUpdate['display_at'] ?? null;
        $this->deliver_notifications = $incidentUpdate['deliver_notifications'];
        $this->custom_tweet = $incidentUpdate['custom_tweet'];
        $this->tweet_id = $incidentUpdate['tweet_id'];

        foreach ($incidentUpdate['affected_components'] as $component) {
            $affectedComponent = new AffectedComponent($component);
            $this->affected_components[$affectedComponent->code] = $affectedComponent;
        }
    }
}
