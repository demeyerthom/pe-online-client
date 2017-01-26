<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26-1-17
 * Time: 22:32
 */

namespace Demeyerthom\PeOnline\Interfaces;

interface AttendanceInterface
{
    public function getPECourseID();

    public function setPECourseID($PECourseID);

    public function getExternalCourseID();

    public function setExternalCourseID($externalCourseID);

    public function getExternalPersonID();

    public function setExternalPersonID($externalPersonID);

    public function getPEModuleID();

    public function setPEModuleID($PEModuleID);

    public function getExternalmoduleID();

    public function setExternalmoduleID($externalmoduleID);

    public function getEndDate(): \DateTime;

    public function setEndDate($endDate);

    public function getPEEditionID();

    public function setPEEditionID($PEEditionID);

    public function getPEMeetingID();

    public function setPEMeetingID($PEMeetingID);

    public function getExternalMeetingID();

    public function setExternalMeetingID($externalMeetingID);
}