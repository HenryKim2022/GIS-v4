<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution_Model extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_institution';
    protected $primaryKey = 'institu_id';
    protected $fillable = ['institu_id', 'institu_name', 'institu_npsn', 'institu_logo', 'mark_id', 'cat_id'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];



    public function tb_mark()
    {
        return $this->belongsTo(Mark_Model::class, 'mark_id');
    }   // Set relation with tb_mark bound by mark_id (one to one)

    public function tb_category()
    {
        return $this->belongsTo(Category_Model::class, 'cat_id');
    }   // Set relation with tb_category bound by cat_id (one to one)

    public function tb_image()
    {
        return $this->hasMany(Image_Model::class, 'institu_id');
    }   // Set relation with tb_category bound by institu_id (one to many)




}
