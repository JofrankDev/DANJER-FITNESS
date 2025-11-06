<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_sessions', function (Blueprint $table) {
            $table->enum('status', ['reserved', 'confirmed', 'cancelled', 'completed'])
                  ->default('reserved')
                  ->after('attendance');
            $table->timestamp('reserved_at')->nullable()->after('status');
            $table->timestamp('cancelled_at')->nullable()->after('reserved_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_sessions', function (Blueprint $table) {
            $table->dropColumn(['status', 'reserved_at', 'cancelled_at']);
        });
    }
};
