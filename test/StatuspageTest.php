<?php

namespace KartanoTest;

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

        print_r($page);
    }
}
