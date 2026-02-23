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
public function up(): void
{
    Schema::create('client_signatures', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('report_id')->unique();
        $table->string('url', 500);
        $table->dateTime('signed_at')->useCurrent();

        $table->foreign('report_id')->references('id')->on('intervention_reports');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_signatures');
    }
};
