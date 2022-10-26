<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Models\Roles'); 
 		//hai model admin , role giao nhau tạo thành admin_role
 		//trong 1 admin có nhiều role
 		//trong 1 role có nhiều admin sử dụng



 	}

 	public function getAuthPassword(){
 		return $this->admin_password;
 	}


 	public function hasAnyRoles($roles){

 		
 		return null !== $this->roles()->whereIn('name',$roles)->first();
 	
 	}


 	//hàm tìm kiếm trong giao ước , nếu tìm thấy bởi tên của roles thì trả ra true
 	public function hasRole($role){
 		return null !== $this->roles()->where('name',$role)->first();
 	}
}
