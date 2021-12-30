<?php
namespace Mezon\Rules\Complex;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage RulesInAnyOrder
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * This rule tries to apply subrules in any order it can
 *
 * @author gdever
 */
class RulesInAnyOrder extends RulesSet
{

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        // iterate through the string
        do {
            // find the one wich fits
            $newIterator = $iterator;
            $atLeastOneRuleWasApplied = false;
            foreach ($this->getRules() as $rule) {
                $singleRuleWasApplied = false;
                $newIterator = $rule->validate(clone $newIterator, $singleRuleWasApplied);

                // set $atLeastOneRuleWasApplied to true if at least one rule from set was applied
                $atLeastOneRuleWasApplied = $singleRuleWasApplied ? true : $atLeastOneRuleWasApplied;
                $ruleWasApplied = $singleRuleWasApplied ? true : $ruleWasApplied;
            }

            // rules were not applied during the last iteration
            if ($atLeastOneRuleWasApplied === false) {
                return $iterator;
            }

            $iterator = $newIterator;
        } while ($iterator->current() !== $iterator->end());

        // return result
        return $iterator;
    }
}
