<?php
namespace Mezon\Rules\Terminal\CharSet;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Base class for the rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage OneOrMoreBase
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base class for the rule wich allows the defined set of characters
 * Empty strings are not allowed.
 * At least one character from the defined set of chars.
 *
 * @author gdever
 */
abstract class OneOrMoreBase implements RuleInterface
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
     * Validating that at least one symbol from the charset exists
     *
     * @param StringIterator $iterator
     *            iterator
     * @param bool $ruleWasApplied
     *            was the rule applied
     * @return StringIterator iterator
     */
    protected function validateStrict(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
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
