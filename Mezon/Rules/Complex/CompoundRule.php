<?php
namespace Mezon\Rules\Complex;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage CompoundRule
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * This rule tries to apply all subrules one by one
 *
 * @author gdever
 */
class CompoundRule extends RulesSet
{
    
    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        // iterate through all rules one by one
        $newIterator = clone $iterator;
        foreach ($this->getRules() as $rule) {
            $newIterator = $rule->validate($newIterator, $ruleWasApplied);

            if ($ruleWasApplied === false) {
                // all rules were applied ot nothing
                return $iterator;
            }
        }

        // return result
        return $newIterator;
    }
}
