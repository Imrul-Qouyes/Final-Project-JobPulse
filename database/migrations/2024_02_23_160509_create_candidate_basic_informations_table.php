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
        Schema::create('candidate_basic_informations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('date_of_birth');
            $table->string('blood_group');
            $table->string('nid');
            $table->string('passport_no')->nullable();
            $table->string('cellphone_no');
            $table->string('emergency_contact_no');
            $table->string('email');
            $table->string('whatsapp_no')->nullable();
            $table->string('linkedin_link');
            $table->string('fb_id')->nullable();
            $table->string('github_link')->nullable();
            $table->string('behance_or_dribble_link')->nullable();
            $table->string('portfolio_link')->nullable();

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('id')->on('candidates')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_basic_informations');
    }
};
