<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_Model extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_category';
    protected $primaryKey = 'cat_id';
    protected $fillable = ['cat_id', 'cat_name'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];


    public function tb_institution()
    {
        return $this->hasMany(Institution_Model::class, 'cat_id');
    }

    // Rename the cat_name attribute to name
    public function getNameAttribute()
    {
        return $this->cat_name;
    }
}
