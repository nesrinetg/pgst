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
    Schema::create('tickets', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('reference', 50)->unique();

        $table->uuid('client_id');
        $table->uuid('zone_id');
        $table->uuid('sla_id');

        $table->enum('type', ['INSTALLATION','PANNE','AUTRE']);
        $table->enum('priorite', ['BASSE','MOYENNE','HAUTE','CRITIQUE']);
        $table->enum('statut', ['NOUVEAU','AFFECTE','EN_COURS','EN_RETARD','CLOTURE','ANNULE'])->default('NOUVEAU');

        $table->dateTime('created_at')->useCurrent();
        $table->dateTime('deadline_at');

        $table->text('description')->nullable();

        $table->index('client_id', 'fk_ticket_client');
        $table->index('zone_id', 'fk_ticket_zone');
        $table->index('sla_id', 'fk_ticket_sla');

        $table->foreign('client_id')->references('id')->on('clients');
        $table->foreign('zone_id')->references('id')->on('zones');
        $table->foreign('sla_id')->references('id')->on('sla');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
