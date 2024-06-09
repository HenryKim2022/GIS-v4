<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Developer_Model extends Model
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_developers';
    protected $primaryKey = 'dev_id';
    protected $fillable = ['dev_id', 'dev_firstname', 'dev_lastname', 'dev_job', 'dev_image'];

    protected $hidden = [
        'dev_image',
    ];
    public function getDevImage()
    {
        return $this->dev_image;
    }
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
