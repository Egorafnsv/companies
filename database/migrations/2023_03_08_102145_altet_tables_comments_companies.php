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
        Schema::table('companies', function(Blueprint $table){
            $table->string('number', 25)->change();
        });
        Schema::table('comments', function(Blueprint $table){
            $table->dropColumn('updated_at');
            $table->timestamp('created_at')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function(Blueprint $table){
            $table->string('number', 15)->change();
        });
        Schema::table('comments', function(Blueprint $table){
            $table->timestamp('updated_at');
            $table->timestamp('created_at')->nullable(true)->change();
        });
    }
};
