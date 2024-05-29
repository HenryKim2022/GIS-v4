<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_image', function (Blueprint $table) {
            $table->id('img_id');
            $table->string('img_title', 45);
            $table->string('img_alt', 45);
            $table->string('img_descb', 45);
            $table->string('img_src', 255);
            $table->foreignId('institu_id')->constrained('tb_institution', 'institu_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_image', function (Blueprint $table) {
            $table->dropForeign(['institu_id']);
        });

        Schema::dropIfExists('tb_image');
    }
};
