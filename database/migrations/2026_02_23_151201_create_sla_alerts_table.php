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
    Schema::create('sla_alerts', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('ticket_id');
        $table->enum('type', ['WARNING','BREACH']);
        $table->string('message', 255);

        $table->dateTime('created_at')->useCurrent();
        $table->dateTime('read_at')->nullable();

        $table->index('ticket_id', 'idx_alert_ticket');
        $table->foreign('ticket_id')->references('id')->on('tickets');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sla_alerts');
    }
};
