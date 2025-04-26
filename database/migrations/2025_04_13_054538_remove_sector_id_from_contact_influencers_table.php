<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contact_influencers', function (Blueprint $table) {
            $table->dropForeign(['sector_id']); // drop the foreign key first
            $table->dropColumn('sector_id');    // then drop the column
        });
    }

    public function down()
    {
        Schema::table('contact_influencers', function (Blueprint $table) {
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');
        });
    }

};
