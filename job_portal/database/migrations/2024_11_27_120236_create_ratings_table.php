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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('employer_profiles')->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained('jobseeker_profiles')->onDelete('cascade');
            $table->integer('rating')->notNull()->comment('Rating from 1 to 5');
            $table->text('review')->nullable();
            $table->timestamps();

            $table->unique(['employer_id', 'job_seeker_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
