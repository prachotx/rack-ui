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
        Schema::create('packings', function (Blueprint $table) {
            $table->id();
            $table->date('pack_date');
            $table->string('code');
            $table->string('remark');
            $table->foreignId('pack_user_id')->nullable();
            $table->foreignId('approve_user_id')->nullable();
            $table->enum('status', ['draft', 'confirm', 'approve', 'cancel', 'reject']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packings');
    }
};
