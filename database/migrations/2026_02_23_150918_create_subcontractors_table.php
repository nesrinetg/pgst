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
    Schema::create('subcontractors', function (Blueprint $table) {

        // IMPORTANT : même type que users.id (Laravel) => bigint unsigned
        $table->unsignedBigInteger('id')->primary();

        $table->string('code', 50)->unique();
        $table->string('societe', 150);

        $table->integer('charge_courante')->default(0);

        // sla.id chez toi est uuid ? (dans phpMyAdmin on voit sla_id) -> garde uuid
        $table->uuid('sla_id')->nullable();

        $table->timestamps();

        // ✅ FK correcte
        $table->foreign('id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('subcontractors');
    }
};
