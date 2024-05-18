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
        Schema::create('diagnostic_patient', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('diagnostic_id')
                ->constrained('diagnostics')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUuid('patient_id')
                ->constrained('patients')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('observation')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_patient');
    }
};
