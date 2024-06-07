<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultPhoto = env('APP_NOIMAGE', 'public/img/noimage.png');
        Schema::create('tb_users', function (Blueprint $table) use ($defaultPhoto) {
            $table->id('user_id');
            $table->string('firstname', 45);
            $table->string('lastname', 45);
            $table->string('user_name', 45);
            $table->string('user_email')->unique();
            $table->string('user_pwd', 255);
            $table->string('user_image', 255)->default($defaultPhoto);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('type')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
