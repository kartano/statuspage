<?php

namespace KartanoTest;

use Kartano\Statuspage\PageElements\AffectedComponent;
use Kartano\Statuspage\PageElements\Incident;
use Kartano\Statuspage\Statuspage;
use PHPUnit\Framework\TestCase;

class StatuspageTest extends TestCase
{
    public function testPageLoad(): void
    {
        $rawJson = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'rawjson.txt');
        $page = Statuspage::getFromJSONString($rawJson);
        $this->assertEquals('Clever', $page->page->name);
        $this->assertEquals('https://status.clever.com', $page->page->url);
        $this->assertEquals(50, count($page->incidents));

        // SM:  Invalid ID should throw exception
        try {
            $page->page->id = 'NOT_VALID';
            $this->fail('Invalid ID test should fail');
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals('ID NOT_VALID is not valid.', $e->getMessage());
        }
    }

    public function testGetComponents(): void
    {
        $rawJson = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'rawjson.txt');
        $page = Statuspage::getFromJSONString($rawJson);

        $results = $page->getComponents('Single Sign-On');
        foreach ($results as $result) {
            $this->assertEquals('Single Sign-On', $result['name']);
        }

        $results = $page->getComponents('/Skyward$/', true);
        foreach ($results as $result) {
            $this->assertStringEndsWith('Skyward', $result['name']);
        }
    }
}
