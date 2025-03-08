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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->integer('specialist_id');
            $table->integer('task_id');
            $table->string('year');
            $table->integer('division_id');
            $table->integer('model_id');
            $table->string('misc');
            $table->boolean('info_type')->nullable();
            $table->integer('info_number')->nullable();
            $table->text('details');
            $table->mediumBinary('attachments')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
