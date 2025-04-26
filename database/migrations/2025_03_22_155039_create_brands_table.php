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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('logo_image')->nullable();
            $table->string('brandName')->nullable();
            $table->enum('brandSize', ['Petite', 'Moyenne', 'Grande'])->nullable();
            $table->text('brandDescription')->nullable();
            $table->string('brandLocalisation')->nullable();
            $table->foreignId('pack_id')->constrained('packs')->onDelete('cascade');
            $table->foreignId('collaboration_id')->nullable()->constrained('collaborations')->onDelete('cascade');
            $table->foreignId('sector_id')->nullable()->constrained('sectors')->onDelete('cascade');  // Make sector_id nullable
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
