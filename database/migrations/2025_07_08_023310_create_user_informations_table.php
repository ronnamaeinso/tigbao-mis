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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('fname')->notNull();
            $table->string('mname')->nullable();
            $table->string('lname')->notNull();
            $table->date('bdate')->notNull();
            $table->string('bplace')->notNull();
            $table->unsignedSmallInteger('id_type')->notNull();
            $table->longText('id_picture')->notNull();
            $table->string('contact_number')->notNull();
            $table->unsignedTinyInteger('sex')->notNull();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_informations');
    }
};
