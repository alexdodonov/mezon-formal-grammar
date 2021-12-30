<?php
namespace Mezon\Rules\Terminal\Literal\CaseSensitive;

use Mezon\Rules\Terminal\Literal\CaseInSensitive\CaseInSensitiveLiteralOrNothingBase;

/**
 * Rule wich defines case sensitive literal or empty string
 *
 * @package FormalGrammar
 * @subpackage CaseSensitiveLiteralOrNothing
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich defines case sensitive literal or empty string
 *
 * @author gdever
 */
class CaseSensitiveLiteralOrNothing extends CaseInSensitiveLiteralOrNothingBase
{

    /**
     * Constructor
     *
     * @param string $literal
     *            the defined literal
     */
    public function __construct(string $literal)
    {
        parent::__construct(new CaseSensitiveLiteral($literal));
    }
}

