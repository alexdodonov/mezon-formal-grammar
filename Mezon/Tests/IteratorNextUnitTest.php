<?php
namespace Mezon\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\StringIterator;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class IteratorNextUnitTest extends TestCase
{

    /**
     * Testing method next()
     */
    public function testNext(): void
    {
        // setup
        $iterator = new StringIterator('012');

        // test body and assertions
        $iterator->next();
        $this->assertEquals(1, $iterator->current());

        $iterator->next();
        $this->assertEquals(2, $iterator->current());

        $this->assertTrue($iterator->next(- 2));
    }

    /**
     * Testing big step for the next() method
     */
    public function testBigStep(): void
    {
        // setup
        $iterator = new StringIterator('  ');

        // test body and assertions
        $this->assertTrue($iterator->next(1));
        $this->assertFalse($iterator->next(5));
    }
}
