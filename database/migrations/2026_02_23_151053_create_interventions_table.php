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
    Schema::create('interventions', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('ticket_id')->unique();                 // tickets.id = uuid
        $table->unsignedBigInteger('subcontractor_id');      // subcontractors.id = bigint

        $table->enum('statut_terrain', ['EN_ROUTE','EN_COURS','TERMINEE'])->default('EN_ROUTE');
        $table->dateTime('started_at')->nullable();
        $table->dateTime('ended_at')->nullable();

        $table->decimal('last_latitude', 10, 7)->nullable();
        $table->decimal('last_longitude', 10, 7)->nullable();

        $table->timestamps();

        $table->foreign('ticket_id')->references('id')->on('tickets')->cascadeOnDelete();
        $table->foreign('subcontractor_id')->references('id')->on('subcontractors')->cascadeOnDelete();
    });
}    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
};
