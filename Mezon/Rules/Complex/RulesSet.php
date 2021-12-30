<?php
namespace Mezon\Rules\Complex;

use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage RulesSet
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * This rule tries to apply subrules in any order it can
 *
 * @author gdever
 */
abstract class RulesSet implements RuleInterface
{

    /**
     * List of rules
     *
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * Constructor
     */
    public function __construct(RuleInterface ...$rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * Method adds rule
     *
     * @param RuleInterface $rule
     *            rule to be added
     */
    public function addRule(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    /**
     * Method returns the list of rules
     *
     * @return RuleInterface[] list of rules
     */
    protected function getRules(): array
    {
        return $this->rules;
    }
}
