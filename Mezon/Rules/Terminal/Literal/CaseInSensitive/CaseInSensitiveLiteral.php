<?php
namespace Mezon\Rules\Terminal\Literal\CaseInSensitive;

use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteralBase;

/**
 * Rule wich defines case sensitive literal
 *
 * @package FormalGrammar
 * @subpackage CaseSensitiveLiteral
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich defines case sensitive literal
 *
 * @author gdever
 */
class CaseInSensitiveLiteral extends CaseSensitiveLiteralBase
{

    /**
     *
     * {@inheritdoc}
     * @see CaseSensitiveLiteralBase::compare()
     */
    protected function compare(string $str1, string $str2): bool
    {
        return strcasecmp($str1, $str2) === 0;
    }
}
