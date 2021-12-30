<?php
namespace Mezon\Tests\Rules\CaseSensitive;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Terminal\CharSet\MoreThanOne;
use Mezon\Rules\Terminal\Literal\CaseInSensitive\CaseInSensitiveLiteral;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CaseInSensitiveLiteralUnitTest extends TestCase
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
            // #1, the second case, matches
            [
                'Literal',
                true
            ],
            // #2, the third case, not matches
            [
                'liter',
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
        $rule->addRule(new CaseInSensitiveLiteral('literal'));
        $rule->addRule(new MoreThanOne(' '));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
