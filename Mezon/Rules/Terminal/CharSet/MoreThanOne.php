<?php
namespace Mezon\Rules\Terminal\CharSet;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage MoreThanOne
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich allows the defined set of characters.
 * Empty strings are not allowed. At least one character from the defined set of chars.
 *
 * @author gdever
 */
class MoreThanOne implements RuleInterface
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
        $ruleWasApplied = false;
        $startPosition = $iterator->current();

        // we have reached the end of the string
        if ($iterator->current() === $iterator->end()) {
            // empty strings are not allowed
            return $iterator;
        }

        do {} while (strpos($this->charSet, $iterator->get()) !== false && $iterator->next());

        // at least one symbol must be found
        $ruleWasApplied = $iterator->current() > $startPosition;

        return $iterator;
    }
}
