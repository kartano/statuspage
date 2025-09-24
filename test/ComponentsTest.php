<?php

namespace KartanoTest;

use Kartano\Statuspage\Components;
use PHPUnit\Framework\TestCase;

class ComponentsTest extends TestCase
{
    public function testPageLoad(): void
    {
        // phpcs:disable Generic.Files.LineLength
        $rawJson = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'test_data' . DIRECTORY_SEPARATOR . 'components.txt');
        // phpcs:enable Generic.Files.LineLength
        $page = Components::getFromJSONString($rawJson);
        $this->assertEquals('Clever', $page->page->name);
        $this->assertEquals('https://status.clever.com', $page->page->url);
        $this->assertCount(21, $page->components);
    }
}
