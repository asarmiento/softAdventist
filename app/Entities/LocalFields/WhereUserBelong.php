<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 28/12/2018
 * Time: 12:04:PM
 */

namespace app\Entities\LocalFields;


use App\Entities\Church;
use App\Entities\Departaments\ListDepartament;
use App\Entities\Entity;
use App\Entities\Union;

/**
 * Class WhereUserBelong
 * @package app\Entities\LocalFields
 */
class WhereUserBelong extends Entity
{
    protected $table = 'where_user_belongs';

    protected $fillable = ['user_id', 'cargo', 'church_id', 'local_field_id', 'union_id','list_departament_id'];


    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function localField()
    {
        return $this->belongsTo(LocalField::class);
    }

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function listDeparmaent()
    {
        return $this->belongsTo(ListDepartament::class);
    }
}
