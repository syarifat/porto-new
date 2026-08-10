<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('credential_url');
        });

        // Auto-fill sort_order for existing records based on issued_date DESC
        $certs = DB::table('certificates')->orderByRaw('ISNULL(issued_date), issued_date DESC')->get();
        foreach ($certs as $i => $cert) {
            DB::table('certificates')->where('id', $cert->id)->update(['sort_order' => $i + 1]);
        }
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
