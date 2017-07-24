<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 20/04/2017
 * Time: 05:17 PM
 */

function currentUser()
{
    return auth()->user();
}

function churchSession($church)
{
    \Session::put('church', $church);
}

function userChurch()
{

    return \Session::get('church');
}
