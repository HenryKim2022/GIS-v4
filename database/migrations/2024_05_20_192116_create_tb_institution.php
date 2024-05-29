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
        Schema::create('tb_institution', function (Blueprint $table) {
            $table->id('institu_id');
            $table->string('institu_name', 45);
            $table->string('institu_npsn', 20);
            $table->string('institu_logo', 255);
            $table->foreignId('mark_id')->constrained('tb_mark', 'mark_id'); // Specify 'mark_id' as the foreign key column
            $table->foreignId('cat_id')->constrained('tb_category', 'cat_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_institution', function (Blueprint $table) {
            $table->dropForeign(['mark_id']);
            $table->dropForeign(['cat_id']);
        });

        Schema::dropIfExists('tb_mark');
        Schema::dropIfExists('tb_category');
        Schema::dropIfExists('tb_institution');
    }
};
