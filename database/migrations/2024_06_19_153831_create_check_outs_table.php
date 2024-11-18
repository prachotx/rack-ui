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
        Schema::create('check_outs', function (Blueprint $table) {
            $table->id();
            $table->date('out_date');
            $table->string('code');
            $table->string('remark')->nullable();
            $table->foreignId('out_user_id')->nullable();
            $table->foreignId('approve_user_id')->nullable();
            $table->enum('status',['draft', 'confirm', 'approve', 'cancel', 'reject']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_outs');
    }
};
