<?php

namespace App\Models;

// use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Casts\Attribute;


class User_Model extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'firstname', 'lastname', 'user_name', 'user_email', 'user_pwd', 'type', 'user_image'];

    protected $hidden = [
        'user_pwd',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_pwd' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["admin", "institutions"][$value],
        );
    }

    // protected function type($value){
    //     return ["admin", "institution"][$value];
    // }

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
