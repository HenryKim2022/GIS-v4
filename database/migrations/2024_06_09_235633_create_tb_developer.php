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
        Schema::create('tb_developers', function (Blueprint $table) use ($defaultPhoto) {
            $table->bigInteger('dev_id')->primary();
            $table->string('dev_firstname', 45);
            $table->string('dev_lastname', 45);
            $table->string('dev_job', 45);
            $table->string('dev_image', 255)->default($defaultPhoto);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_developers');
    }
};
