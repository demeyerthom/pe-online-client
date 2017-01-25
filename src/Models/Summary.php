<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 15:49
 */

namespace Demeyerthom\PeOnline\Models;


use Illuminate\Support\Collection;

class Summary extends Model
{
    /**
     * @var Results
     */
    protected $attributes = [
        'results' => null,
        'errors' => null,
        'accepted' => null,
        'attendances' => null,
        'settings' => null
    ];

    public function __construct()
    {
        $this->attributes['accepted'] = new Collection();
        $this->attributes['errors'] = new Collection();
        $this->attributes['attendances'] = new Collection();
    }


}