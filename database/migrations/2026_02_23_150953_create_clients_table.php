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
    Schema::create('clients', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('numero_client', 50)->unique();

        $table->enum('type_client', ['PARTICULIER','ENTREPRISE'])->default('PARTICULIER');

        $table->string('nom', 150)->nullable();
        $table->string('prenom', 150)->nullable();

        $table->string('cin', 50)->nullable();
        $table->string('registre_commerce', 50)->nullable();

        $table->string('telephone', 30)->nullable();
        $table->string('telephone2', 30)->nullable();
        $table->string('email', 150)->nullable();

        $table->string('adresse', 255);
        $table->string('complement_adresse', 255)->nullable();
        $table->string('code_postal', 20)->nullable();

        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();
        $table->integer('precision_gps_m')->nullable();

        $table->uuid('zone_id');

        $table->enum('statut', ['ACTIF','INACTIF'])->default('ACTIF');

        $table->dateTime('created_at')->useCurrent();
        $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();

        $table->index('zone_id', 'idx_client_zone');
        $table->index('telephone', 'idx_client_tel');

        $table->foreign('zone_id')->references('id')->on('zones');
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
