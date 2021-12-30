<?php
namespace Mezon\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Complex\AnyRuleFromSet;
use Mezon\Rules\Complex\CompoundRule;
use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteral;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ComplexConstructorsUnitTest extends TestCase
{

    /**
     * Testing constructor for the class AnyRuleFromSet
     */
    public function testAnyRuleFromSetConstructor(): void
    {
        // setup
        $grammar = new FormalGrammar(new AnyRuleFromSet(new CaseSensitiveLiteral('a'), new CaseSensitiveLiteral('b')));

        // test body and assertions
        $this->assertTrue($grammar->validate('a'));
        $this->assertTrue($grammar->validate('b'));
        $this->assertFalse($grammar->validate('ab'));
    }

    /**
     * Testing constructor for the class CompoundRule
     */
    public function testCompoundRuleConstructor(): void
    {
        // setup
        $grammar = new FormalGrammar(new CompoundRule(new CaseSensitiveLiteral('a'), new CaseSensitiveLiteral('b')));

        // test body and assertions
        $this->assertFalse($grammar->validate('a'));
        $this->assertFalse($grammar->validate('b'));
        $this->assertTrue($grammar->validate('ab'));
    }

    /**
     * Testing constructor for the class RulesInAnyOrder
     */
    public function testRulesInAnyOrderConstructor(): void
    {
        // setup
        $grammar = new FormalGrammar(new RulesInAnyOrder(new CaseSensitiveLiteral('a'), new CaseSensitiveLiteral('b')));

        // test body and assertions
        $this->assertTrue($grammar->validate('ab'));
        $this->assertTrue($grammar->validate('ba'));
        $this->assertTrue($grammar->validate('abbbaaaaaaabb'));
    }
}
