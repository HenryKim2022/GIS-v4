<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;




class Developer_Model extends Model
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_developers';
    protected $primaryKey = 'dev_id';
    protected $fillable = ['dev_id', 'dev_firstname', 'dev_lastname', 'dev_job', 'dev_image', 'user_id'];

    protected $hidden = [
        'dev_image',
    ];

    public function tb_users()
    {
        return $this->belongsTo(User_Model::class, 'user_id');
    }

    public function getDevImage()
    {
        $imagePath = $this->dev_image ?: $this->getUserImage();
        return $this->removeBackgroundUsingPHP_GD($imagePath);
    }

    public function getUserImage()
    {
        if ($this->tb_users) {
            $imagePath = $this->tb_users->user_image ?: env('APP_NOIMAGE');
            return $this->removeBackgroundUsingPHP_GD($imagePath);
        }
        // else {
        return null;
        // }
    }

    public function removeBackgroundUsingPHP_GD($imagePath)                             //// USING PHP GD METHOD
    {
        $image = imagecreatefromstring(file_get_contents($imagePath)) ?: imagecreatefromstring(file_get_contents(env('APP_URL') . '/' . $imagePath));
        imagesavealpha($image, true);
        $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $transparentColor);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);
        return 'data:image/png;base64,' . base64_encode($imageData);
    }


    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
