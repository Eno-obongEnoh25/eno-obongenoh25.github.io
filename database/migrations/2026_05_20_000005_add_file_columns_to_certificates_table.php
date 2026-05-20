<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('verify_url');
            $table->string('file_original_name')->nullable()->after('file_path');
            $table->string('file_mime_type')->nullable()->after('file_original_name');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_original_name', 'file_mime_type']);
        });
    }
};

