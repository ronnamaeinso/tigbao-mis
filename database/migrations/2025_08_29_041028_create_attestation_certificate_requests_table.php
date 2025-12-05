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
        Schema::create('attestation_certificate_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('work')->notNull();
            $table->decimal('monthly_earning')->notNull();
            $table->unsignedInteger('type')->notNull()->comment('1 - for normal request, 2 for customized request');
            $table->unsignedInteger('status')->notNull()->comment('1 for submitted, 2 for approved , and 3 for rejected');
            $table->longText('reject_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestation_certificate_requests');
    }
};
