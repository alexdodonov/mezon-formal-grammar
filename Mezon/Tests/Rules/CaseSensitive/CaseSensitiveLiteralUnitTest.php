<?php
namespace Mezon\Tests\Rules\CaseSensitive;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteral;
use Mezon\Rules\Terminal\CharSet\OneOrMore;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CaseSensitiveLiteralUnitTest extends TestCase
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
                'literal',
                true
            ],
            // #1, the second case, not matches
            [
                'Literal',
                false
            ],
            // #2, the third case, not matches
            [
                'Liter',
                false
            ],
            // #3, the forth case, matches, literal at the beginning of the string
            [
                'literal   ',
                true
            ],
            // #4, matches, literal at the end of the string
            [
                '    literal',
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
        $rule->addRule(new CaseSensitiveLiteral('literal'));
        $rule->addRule(new OneOrMore(' '));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
