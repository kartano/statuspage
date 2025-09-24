<?php

namespace KartanoTest;

use Kartano\Statuspage\Summary;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    public function testLoadSummary(): void
    {
        $rawJson = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'test_data' . DIRECTORY_SEPARATOR . 'summary.txt');
        $summary = Summary::getFromJSONString($rawJson);
        $this->assertEquals('Clever', $summary->page->name);
        $this->assertEquals('https://status.clever.com', $summary->page->url);
        $this->assertEquals('All Systems Operational', $summary->description);
    }
}
