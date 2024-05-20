<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Setup_Default_Users extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_name', 'user_password', 'user_image'];
    protected $dates = ['deleted_at'];

}
