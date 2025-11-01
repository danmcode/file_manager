<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('role_id')
                ->after('id')
                ->constrained('roles');

            $table->foreignId('group_id')
                ->constrained('groups');

            $table->decimal(
                'quota_limit_mb',
                10,
                2
            )->default(10);

            $table->decimal(
                'used_space_mb',
                10,
                2
            )->default(0);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users');

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
            $table->dropConstrainedForeignId('group_id');
            $table->dropColumn([
                'quota_limit_mb',
                'used_space_mb',
                'created_by',
                'updated_by'
            ]);
        });
    }
};