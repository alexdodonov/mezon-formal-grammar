<?php
namespace Mezon\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Terminal\CharSet\MoreThanOne;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RulesInAnyOrderUnitTest extends TestCase
{

    /**
     * Testing data provider
     *
     * @return array testing data
     */
    public function validateDataProvider(): array
    {
        return [
            // #0, the first case, matches
            [
                'aab',
                true
            ],
            // #1, the second case, not matches
            [
                'aac',
                false
            ],
            // #2, the third case, matches
            [
                'bab',
                true
            ],
            // #3, the forth case, not matches
            [
                'cccaaccc',
                false
            ],
            // #4, the fifths case, matches, complex data
            [
                'abababaababababababbbbbaaaaababbabababababababba',
                true
            ]
        ];
    }

    /**
     * Testing method validate for simple cases (context free grammars)
     *
     * @param string $stringToValidate
     *            string to validate
     * @param bool $expectedResult
     *            expected result of validation
     * @dataProvider validateDataProvider
     */
    public function testValidate(string $stringToValidate, bool $expectedResult): void
    {
        // setup
        $rule = new RulesInAnyOrder();
        $rule->addRule(new MoreThanOne('a'));
        $rule->addRule(new MoreThanOne('b'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
