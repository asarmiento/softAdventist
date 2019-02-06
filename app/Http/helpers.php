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

function userSession($user)
{
    \Session::put('user', $user);
}

function campoSession($campo)
{

    \Session::put('campo', $campo);
}

function userType()
{

    return \Session::get('user');
}

function userChurch()
{
    if(currentUser()->whereUserBelong->church_id){
        return \App\Entities\Church::find(currentUser()->whereUserBelong->church_id);
    }else{
        return false;
    }
}

function userCampo()
{
    if (currentUser()->whereUserBelong->local_field_id){
        return currentUser()->whereUserBelong->local_field_id;
    }else{
        return false;
    }
}

function userUnion()
{
    if(currentUser()->whereUserBelong->union_id){
        return currentUser()->whereUserBelong->union_id;
    }else{
        return false;
    }
}
