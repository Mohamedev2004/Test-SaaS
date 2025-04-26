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
        Schema::create('influencers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('profile_image')->nullable();
            $table->string('influencerName')->nullable();
            $table->integer('nbr_abonne')->nullable()->default(0);
            $table->text('influencerDescription')->nullable();
            $table->integer('influencerAge')->nullable();
            $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
            $table->json('influencerPlatforms')->nullable();
            $table->foreignId('sector_id')->nullable()->constrained('sectors')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencers');
    }
};
