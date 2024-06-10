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
    protected $fillable = ['dev_id', 'dev_firstname', 'dev_lastname', 'dev_job', 'dev_image', 'user_id'];

    protected $hidden = [
        'dev_image',
    ];
    // public function getDevImage()
    // {
    //     return $this->dev_image;
    // }

    public function getDevImage()
    {
        $imagePath = $this->dev_image ?: $this->getUserImage();
        // Create a new image with transparency support
        $image = imagecreatefromstring(file_get_contents($imagePath)) ?: imagecreatefromstring(file_get_contents(env('APP_URL'). "/" .$imagePath));
        imagesavealpha($image, true);

        // Set the background color to transparent
        $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $transparentColor);

        // Output the image
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        // Clean up
        imagedestroy($image);

        // Return the image data
        return 'data:image/png;base64,' . base64_encode($imageData);
    }



    public function tb_users()
    {
        return $this->belongsTo(User_Model::class, 'user_id');
    }   // Set relation with tb_users bound by cat_id (one to one)

    // public function getUserImage()
    // {
    //     if ($this->tb_users) {
    //         return $this->tb_users->user_image;
    //     }
    //     return null;
    // }

    public function getUserImage()
    {
        if ($this->tb_users) {
            $imagePath = $this->tb_users->user_image ?: env('APP_NOIMAGE');
            // Create a new image with transparency support
            $image = imagecreatefromstring(file_get_contents($imagePath)) ?: imagecreatefromstring(file_get_contents(env('APP_URL'). "/" .$imagePath));
            imagesavealpha($image, true);
            // Set the background color to transparent
            $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $transparentColor);

            // Output the image
            ob_start();
            imagepng($image);
            $imageData = ob_get_clean();
            // Clean up
            imagedestroy($image);

            // Return the image data
            return 'data:image/png;base64,' . base64_encode($imageData);
        }

        return null;
    }

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
