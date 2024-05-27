<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User_Model extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'firstname', 'lastname', 'user_name', 'user_pwd', 'user_image'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
