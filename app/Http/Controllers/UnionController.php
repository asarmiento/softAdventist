<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 08/09/2017
 * Time: 01:08 PM
 */

namespace App\Http\Controllers;


use App\Entities\Union;

class UnionController extends Controller
{

    public function labelSelect()
    {
        return Union::listsLabel();
    }
}
