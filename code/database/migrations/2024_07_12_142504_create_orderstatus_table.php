<?php

use App\Models\OrderStatus;
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
        Schema::create('orderstatus', function (Blueprint $table) {
            $table->integer('id');
            $table->string('label');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('orderstatus_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderstatus');
    }
};
