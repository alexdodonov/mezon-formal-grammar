<?php
namespace Mezon;

/**
 * String iterator
 *
 * @package FormalGrammar
 * @subpackage StringIterator
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Common interface for all rules
 *
 * @author gdever
 */
class StringIterator
{

    /**
     * String to be iterated
     *
     * @var string
     */
    private $string = '';

    /**
     * Position of the iterator
     *
     * @var integer
     */
    private $cursor = 0;

    /**
     * Constructor
     *
     * @param string $stringToBeIterated
     *            string to be iterated
     */
    public function __construct(string $stringToBeIterated)
    {
        $this->string = $stringToBeIterated;
    }

    /**
     * Method returns ending cursor of the string
     *
     * @return int ending cursor of the string
     */
    public function end(): int
    {
        return strlen($this->string);
    }

    /**
     * Method returns current cursor of the string
     *
     * @return int current cursor of the string
     */
    public function current(): int
    {
        return $this->cursor;
    }

    /**
     * Method returns char in the position of cursor
     *
     * @return string char in the position of cursor
     */
    public function get(): string
    {
        return substr($this->string, $this->cursor, 1);
    }

    /**
     * Method shifts iterator to the next position
     *
     * @param int $shift
     *            shift value
     * @return bool true if the string can be iterated further, false otherwise
     */
    public function next(int $shift = 1): bool
    {
        $length = strlen($this->string);

        if ($this->cursor + $shift > $length) {
            return false;
        }

        $this->cursor += $shift;

        return $this->cursor < $length;
    }
}