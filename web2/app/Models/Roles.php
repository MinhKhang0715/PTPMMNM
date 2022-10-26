<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name'
    ];
    protected $primaryKey = 'id_roles';
 	protected $table = 'tbl_roles';

 	public function admin(){
 		return $this->belongsToMany('App\Models\Admin');
 		//hai model admin , role giao nhau tạo thành admin_role
 		//trong 1 admin có nhiều role
 		//trong 1 role có nhiều admin sử dụng
 	}

}
