<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 11:08
 */

namespace Demeyerthom\PeOnline\Models;

use Demeyerthom\PeOnline\Exceptions\WrongInputException;


/**
 * Een cursus is in PE-online van een bepaald type:
 * 1: Cursus met fysieke bijenkomsten, accreditatie per bijeenkomst
 * 2: E-learning
 * 3: Expertisegroepen
 * 4: Cursus met fysieke bijeenkomsten, accreditatie voor totaal
 *
 * Type 2 en 3 kenmerken zich doordat er vooraf geen uitvoeringsdata worden ingevoerd, bij Type 1 en 4 moet en in PE-online vooraf de uitvoeringsdata bekend zijn.
 * In PE-online is op het cursus detail scherm zichtbaar wat voor type het betreft.
 *
 * Class Attendance
 * @package Demeyerthom\PeOnline\Models
 */
class Attendance extends Model
{
    protected $attributes = [
        'PECourseID' => null,
        'externalCourseID' => null,
        'externalPersonID' => null,
        'PEModuleID' => null,
        'externalmoduleID' => null,
        'endDate' => null,
        'PEEditionID' => null,
        'externalEditionID' => null,
        'PEMeetingID' => null,
        'externalMeetingID' => null,
    ];

    protected $datetime = [
        'endDate'
    ];


}