<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:51
 */

namespace Demeyerthom\PeOnline\Models;

use DateTime;


class Accepted extends Model
{
    protected $person;
    protected $course;
    protected $date;

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    /**
     * @return mixed
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        if ($date instanceof DateTime) {
            $this->date = $date;
            return;
        }
        $this->date = new DateTime($date);
    }


}