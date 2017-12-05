<?php
	/**
	 * Created by PhpStorm.
	 * User: Anwar
	 * Date: 04/10/2017
	 * Time: 03:45 PM
	 */
	
	namespace App\Entities\LocalFields;
	
	
	use App\Entities\Entity;
	
	class CheckICByLF extends Entity
	{
		protected $table = 'check_i_c_by_l_f';
		
		protected $fillable = ['balance','status','token','internal_control_id','check_id','user_id'];
	}