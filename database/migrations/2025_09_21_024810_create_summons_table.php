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
        Schema::create('summons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('kaso_sa_brgy_isip');
            $table->longText('mga_nagsumbong');
            $table->longText('mga_gisumbong');
            $table->longText('bahin_sa');
            $table->dateTime('petsa');
            $table->unsignedInteger('status')->default(1);
            $table->longText('reject_comment')->nullable();
            $table->timestamps();
            $table->dateTime('generated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summons');
    }
};
