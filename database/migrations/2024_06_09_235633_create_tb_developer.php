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
        // Schema::create('tb_developers', function (Blueprint $table) use ($defaultPhoto) {
        Schema::create('tb_developers', function (Blueprint $table) {
            $table->bigInteger('dev_id')->primary();
            $table->string('dev_firstname', 45);
            $table->string('dev_lastname', 45);
            $table->string('dev_job', 45);
            $table->string('dev_image', 255)->nullable();
            $table->foreignId('user_id')->constrained('tb_users', 'user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_developers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('tb_developers');
    }
};
