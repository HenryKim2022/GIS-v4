<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mark_Model extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_mark';
    protected $primaryKey = 'mark_id';
    protected $fillable = ['mark_id', 'mark_lat', 'mark_lon', 'mark_address'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];



    // public function into_institution()
    // {
    //     return $this->hasOne(Institution_Model::class, 'mark_id');
    // }   // Set relation with tb_institution by mark_id, the other part was in Institution_Model.php
}
