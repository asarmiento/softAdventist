<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 07/09/2017
 * Time: 10:40 PM
 */

namespace App\Entities;

use App\Entities\LocalFields\LocalField;


/**
 * Class Union
 * @package app\Entities
 */
class Union extends Entity
{
    protected $table = 'unions';
    protected $fillable = ['name','token','country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-16
     * @TimeCreate: 6:24 pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     * *
     */
    public function localFields()
    {
        return $this->hasMany(LocalField::class);
    }

    public static function listsLabel()
    {
        $unions = self::all();
        $lists = [];
        foreach ($unions AS $union)
        {
            array_push($lists, ['label' =>  $union->name, 'value' => $union->id]);
        }

        return $lists;
    }
}
