<?php
namespace Mezon\Tests\Rules\CharSet;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Terminal\CharSet\MoreThanOne;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class MoreThanOneUnitTest extends TestCase
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
            // #1, the second case, unexpected symbol
            [
                'aac',
                false
            ]
        ];
    }

    /**
     * Testing method validate for MoreThanOneCharFromSet rule
     *
     * @param string $stringToValidate
     *            string to validate
     * @param bool $expectedResult
     *            expected result of validation
     * @dataProvider validateDataProvider
     */
    public function testMoreThanOneRule(string $stringToValidate, bool $expectedResult): void
    {
        // setup
        $rule = new RulesInAnyOrder();
        $rule->addRule(new MoreThanOne('ab'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
