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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->foreignId('rack_id')->default(1);
            $table->float('depth');            
            $table->float('long');            
            $table->float('height');            
            $table->integer('row_position');            
            $table->integer('column_position');              
            $table->float('support_weight');                 
            $table->float('remain_height');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
