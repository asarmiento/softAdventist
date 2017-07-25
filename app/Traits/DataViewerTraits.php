<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 23/07/2017
 * Time: 05:02 PM
 */

namespace App\Traits;

trait DataViewerTraits
{
    public function scopeSearchPaginateAndOrder($query)
    {
        return $query->paginate(10);
    }
}