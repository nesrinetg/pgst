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
    Schema::create('assignments', function (Blueprint $table) {
        $table->id();

        $table->uuid('ticket_id');                     // tickets.id is UUID
        $table->unsignedBigInteger('subcontractor_id'); // subcontractors.id is bigint

        $table->enum('mode', ['AUTO','MANUEL']);
        $table->string('raison', 255)->nullable();

        $table->dateTime('assigned_at')->useCurrent();

        // ✅ assigned_by is a USER => users.id bigint
        $table->unsignedBigInteger('assigned_by')->nullable();

        $table->timestamps();

        $table->foreign('ticket_id')->references('id')->on('tickets')->cascadeOnDelete();
        $table->foreign('subcontractor_id')->references('id')->on('subcontractors')->cascadeOnDelete();
        $table->foreign('assigned_by')->references('id')->on('users')->nullOnDelete();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
