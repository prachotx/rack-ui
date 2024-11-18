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
        Schema::create('process_pallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pallet_type_id')->nullable();
            $table->foreignId('block_id')->nullable();
            $table->float('height');  
            $table->float('support_weight');   
            $table->float('x_block');
            $table->float('y_block');
            $table->enum('status', ['draft', 'confirm', 'disable']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_pallets');
    }
};
