<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:49
 */

namespace Demeyerthom\PeOnline\Models;


use Illuminate\Support\Collection;

class Summary
{
    /**
     * @var Results
     */
    public $results;
    /**
     * @var Collection
     */
    public $errors;
    /**
     * @var Collection
     */
    public $accepted;

    /**
     * @var Collection
     */
    public $attendances;

    /**
     * @var array
     */
    public $settings;

    public function __construct()
    {
        $this->accepted = new Collection();
        $this->errors = new Collection();
        $this->attendances = new Collection();
    }


}