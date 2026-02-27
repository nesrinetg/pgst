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
    Schema::create('intervention_reports', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('intervention_id')->unique();

        $table->enum('resultat', ['RESOLU','NON_RESOLU']);
        $table->string('motif', 255)->nullable();
        $table->text('commentaire')->nullable();

        $table->dateTime('created_at')->useCurrent();
        $table->dateTime('validated_at')->nullable();

        $table->foreign('intervention_id')->references('id')->on('interventions');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervention_reports');
    }
};
