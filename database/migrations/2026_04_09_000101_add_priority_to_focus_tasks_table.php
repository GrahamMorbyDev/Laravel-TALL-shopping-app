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
        Schema::table('focus_tasks', function (Blueprint $table) {
            // Add priority enum: low, medium, high. Default to medium.
            if (!Schema::hasColumn('focus_tasks', 'priority')) {
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium')->after('is_completed');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('focus_tasks', function (Blueprint $table) {
            if (Schema::hasColumn('focus_tasks', 'priority')) {
                $table->dropColumn('priority');
            }
        });
    }
};
