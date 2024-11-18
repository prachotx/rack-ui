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
        Schema::create('packing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_id');
            $table->foreignId('product_id');
            $table->foreignId('process_pallet_id')->nullable();
            $table->string('ref_no')->nullable();
            $table->integer('quantity');
            $table->integer('remain_quantity');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_details');
    }
};
