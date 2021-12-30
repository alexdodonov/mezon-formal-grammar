<?php
namespace Mezon\Rules\Terminal\CharSet;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined character from set or nothing
 *
 * @package FormalGrammar
 * @subpackage OneExactlyOrNothing
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich allows the defined character from set or nothing
 * Note that it is ase sensitive
 *
 * @author gdever
 */
class OneExactlyOrNothing implements RuleInterface
{

    /**
     * Charset
     *
     * @var string
     */
    private $charSet = '';

    /**
     * Constructor
     *
     * @param string $charSet
     *            the defined character set
     */
    public function __construct(string $charSet)
    {
        $this->charSet = $charSet;
    }

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        $ruleWasApplied = true;

        if ($iterator->end() !== 0 && strpos($this->charSet, $iterator->get()) !== false) {
            $iterator->next();
        }

        return $iterator;
    }
}
