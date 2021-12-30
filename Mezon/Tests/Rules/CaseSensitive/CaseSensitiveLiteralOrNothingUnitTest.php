<?php
namespace Mezon\Tests\Rules\CaseSensitive;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\AnyRuleFromSet;
use Mezon\Rules\Terminal\CharSet\MoreThanOne;
use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteralOrNothing;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CaseSensitiveLiteralOrNothingUnitTest extends TestCase
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
                ' ',
                true
            ],
            // #1, the second case, matches
            [
                '  ',
                true
            ],
            // #2, the third case, matches
            [
                ' Literal',
                false
            ],
            // #3, the forth case, matches
            [
                ' literal',
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
        $rule = new AnyRuleFromSet();
        $rule->addRule(new MoreThanOne(' '));
        $rule->addRule(new CaseSensitiveLiteralOrNothing('literal'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
