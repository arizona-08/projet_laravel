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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->integer('zip_code')->nullable();
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('agency_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('agency_id');
        });
    }
};
