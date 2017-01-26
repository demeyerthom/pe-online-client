<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 11:08
 */

namespace Demeyerthom\PeOnline\Models;

use DateTime;
use Demeyerthom\PeOnline\Interfaces\AttendanceInterface;


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
class Attendance extends Model implements AttendanceInterface
{
    protected $PECourseID;
    protected $externalCourseID;
    protected $externalPersonID;
    protected $PEModuleID;
    protected $externalmoduleID;
    protected $endDate;
    protected $PEEditionID;
    protected $PEMeetingID;
    protected $externalMeetingID;

    /**
     * @return mixed
     */
    public function getPECourseID()
    {
        return $this->PECourseID;
    }

    /**
     * @param mixed $PECourseID
     */
    public function setPECourseID($PECourseID)
    {
        $this->PECourseID = $PECourseID;
    }

    /**
     * @return mixed
     */
    public function getExternalCourseID()
    {
        return $this->externalCourseID;
    }

    /**
     * @param mixed $externalCourseID
     */
    public function setExternalCourseID($externalCourseID)
    {
        $this->externalCourseID = $externalCourseID;
    }

    /**
     * @return mixed
     */
    public function getExternalPersonID()
    {
        return $this->externalPersonID;
    }

    /**
     * @param mixed $externalPersonID
     */
    public function setExternalPersonID($externalPersonID)
    {
        $this->externalPersonID = $externalPersonID;
    }

    /**
     * @return mixed
     */
    public function getPEModuleID()
    {
        return $this->PEModuleID;
    }

    /**
     * @param mixed $PEModuleID
     */
    public function setPEModuleID($PEModuleID)
    {
        $this->PEModuleID = $PEModuleID;
    }

    /**
     * @return mixed
     */
    public function getExternalmoduleID()
    {
        return $this->externalmoduleID;
    }

    /**
     * @param mixed $externalmoduleID
     */
    public function setExternalmoduleID($externalmoduleID)
    {
        $this->externalmoduleID = $externalmoduleID;
    }

    /**
     * @return mixed
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        if ($endDate instanceof DateTime) {
            $this->endDate = $endDate;
            return;
        }
        $this->endDate = new DateTime($endDate);
    }

    /**
     * @return mixed
     */
    public function getPEEditionID()
    {
        return $this->PEEditionID;
    }

    /**
     * @param mixed $PEEditionID
     */
    public function setPEEditionID($PEEditionID)
    {
        $this->PEEditionID = $PEEditionID;
    }

    /**
     * @return mixed
     */
    public function getPEMeetingID()
    {
        return $this->PEMeetingID;
    }

    /**
     * @param mixed $PEMeetingID
     */
    public function setPEMeetingID($PEMeetingID)
    {
        $this->PEMeetingID = $PEMeetingID;
    }

    /**
     * @return mixed
     */
    public function getExternalMeetingID()
    {
        return $this->externalMeetingID;
    }

    /**
     * @param mixed $externalMeetingID
     */
    public function setExternalMeetingID($externalMeetingID)
    {
        $this->externalMeetingID = $externalMeetingID;
    }


}