<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('nominations')) {
            return;
        }

        Schema::table('nominations', function (Blueprint $table) {
            if (!Schema::hasColumn('nominations', 'reference_id')) {
                $table->string('reference_id')->nullable()->after('id')->index();
            }
            if (!Schema::hasColumn('nominations', 'edition')) {
                $table->string('edition')->default('2026')->after('reference_id');
            }
            if (!Schema::hasColumn('nominations', 'nomination_type')) {
                $table->string('nomination_type')->nullable()->after('edition');
            }
            if (!Schema::hasColumn('nominations', 'nominee_name')) {
                $table->string('nominee_name')->nullable()->after('company');
            }
            if (!Schema::hasColumn('nominations', 'emirate')) {
                $table->string('emirate')->nullable()->after('country');
            }
            if (!Schema::hasColumn('nominations', 'uae_activity')) {
                $table->string('uae_activity')->nullable()->after('emirate');
            }
            if (!Schema::hasColumn('nominations', 'branch_location')) {
                $table->string('branch_location')->nullable()->after('uae_activity');
            }
            if (!Schema::hasColumn('nominations', 'website')) {
                $table->string('website')->nullable()->after('branch_location');
            }
            if (!Schema::hasColumn('nominations', 'supporting_evidence_path')) {
                $table->string('supporting_evidence_path')->nullable()->after('website');
            }
            if (!Schema::hasColumn('nominations', 'whatsapp_permission')) {
                $table->boolean('whatsapp_permission')->default(false)->after('consent2');
            }
            if (!Schema::hasColumn('nominations', 'marketing_consent')) {
                $table->boolean('marketing_consent')->default(false)->after('whatsapp_permission');
            }
            if (!Schema::hasColumn('nominations', 'nomination_state')) {
                $table->string('nomination_state')->default('received')->after('marketing_consent');
            }
            if (!Schema::hasColumn('nominations', 'commercial_state')) {
                $table->string('commercial_state')->default('not_offered')->after('nomination_state');
            }
            if (!Schema::hasColumn('nominations', 'result_state')) {
                $table->string('result_state')->default('not_evaluated')->after('commercial_state');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('nominations')) {
            return;
        }

        Schema::table('nominations', function (Blueprint $table) {
            foreach ([
                'result_state',
                'commercial_state',
                'nomination_state',
                'marketing_consent',
                'whatsapp_permission',
                'supporting_evidence_path',
                'website',
                'branch_location',
                'uae_activity',
                'emirate',
                'nominee_name',
                'nomination_type',
                'edition',
                'reference_id',
            ] as $column) {
                if (Schema::hasColumn('nominations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
