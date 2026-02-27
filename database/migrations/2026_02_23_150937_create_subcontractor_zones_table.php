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
    Schema::create('subcontractor_zones', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('subcontractor_id'); // FK -> subcontractors.id (bigint)
        $table->uuid('zone_id');                        // FK -> zones.id (uuid)

        $table->boolean('actif')->default(true);
        $table->integer('priorite')->default(1);

        $table->integer('capacite_max_jour')->nullable();
        $table->integer('delai_interne_heures')->nullable();

        $table->enum('type_intervention', ['INSTALLATION','PANNE','TOUT'])->default('TOUT');

        $table->date('date_debut');
        $table->date('date_fin')->nullable();

        $table->string('commentaire', 255)->nullable();

        $table->timestamps();

        $table->unique(['subcontractor_id','zone_id','date_debut'], 'uk_sub_zone');

        $table->foreign('subcontractor_id')->references('id')->on('subcontractors')->cascadeOnDelete();
        $table->foreign('zone_id')->references('id')->on('zones')->cascadeOnDelete();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcontractor_zones');
    }
};
