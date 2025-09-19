<?php

declare(strict_types=1);

namespace Kartano\Statuspage;

use Kartano\Statuspage\PageElements\Incident;
use Kartano\Statuspage\PageElements\Page;

final class Statuspage implements \Countable, \ArrayAccess, \Iterator
{
    private $position = 0;

    public ?Page $page = null {
        get => $this->page;
    }

    public array $incidents = [] {
        &get => $this->incidents;
    }

    public function __construct(string $rawJSON)
    {
        $this->position = 0;
        $decodedJSON = json_decode($rawJSON, true);
        $this->page = new Page($decodedJSON['page']);

        foreach ($decodedJSON['incidents'] as $incidentArray) {
            $incident = new Incident($incidentArray, $this);
            $this->incidents[$incident->id] = &$incident;
        }
    }

    public function count(): int
    {
        return count($this->incidents);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->incidents[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->incidents[$offset]) ? $this->incidents[$offset] : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->incidents[] = $value;
        } else {
            $this->incidents[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->incidents[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function current(): mixed
    {
        return $this->incidents[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    #[\ReturnTypeWillChange]
    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->incidents[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
