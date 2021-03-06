<?php

namespace Tests\Unit;

use App\Entry;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EntryTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetPostReturnsNullIfUndefined()
    {
        $entry = new Entry;

        $this->assertNull($entry->getPost());
    }

    public function testGetPostReturnsPost()
    {
        $entry = new Entry;
        $entry->post = 'This is a test';

        $this->assertEquals(
            'This is a test',
            $entry->getPost()
        );
    }

    public function testGetTitleReturnsNullIfUndefined()
    {
        $entry = new Entry;

        $this->assertNull($entry->getTitle());
    }

    public function testGetTitleReturnsTitle()
    {
        $entry = new Entry;
        $entry->title = 'This is a test';

        $this->assertEquals(
            'This is a test',
            $entry->getTitle()
        );
    }
}
