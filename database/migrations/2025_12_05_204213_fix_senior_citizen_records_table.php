<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('senior_citizen_records', function (Blueprint $table) {
            if (!Schema::hasColumn('senior_citizen_records', 'first_name')) {
                $table->string('first_name')->after('id');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'middle_name')) {
                $table->string('middle_name')->nullable()->after('first_name');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'last_name')) {
                $table->string('last_name')->after('middle_name');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'gender')) {
                $table->string('gender')->after('last_name');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'bdate')) {
                $table->date('bdate')->after('gender');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'is_deceased')) {
                $table->boolean('is_deceased')->default(0)->after('bdate');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'date_deceased')) {
                $table->date('date_deceased')->nullable()->after('is_deceased');
            }

            if (!Schema::hasColumn('senior_citizen_records', 'death_certificate')) {
                $table->string('death_certificate')->nullable()->after('date_deceased');
            }
        });
    }

    public function down(): void
    {
        Schema::table('senior_citizen_records', function (Blueprint $table) {
            if (Schema::hasColumn('senior_citizen_records', 'death_certificate')) {
                $table->dropColumn('death_certificate');
            }
            if (Schema::hasColumn('senior_citizen_records', 'date_deceased')) {
                $table->dropColumn('date_deceased');
            }
            if (Schema::hasColumn('senior_citizen_records', 'is_deceased')) {
                $table->dropColumn('is_deceased');
            }
            if (Schema::hasColumn('senior_citizen_records', 'bdate')) {
                $table->dropColumn('bdate');
            }
            if (Schema::hasColumn('senior_citizen_records', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('senior_citizen_records', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if (Schema::hasColumn('senior_citizen_records', 'middle_name')) {
                $table->dropColumn('middle_name');
            }
            if (Schema::hasColumn('senior_citizen_records', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }
};
