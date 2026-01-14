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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('inspection_id')->unique();
            $table->string('case_id');
            $table->foreign('case_id')->references('case_id')->on('cases')->cascadeOnDelete();    
            $table->string('type');
            $table->string('requested_by');
            $table->timestamp('start_ts');
            $table->string('location');
            $table->string('assigned_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
