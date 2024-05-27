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
    protected $fillable = ['mark_id', 'mark_lat', 'mark_lon'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
