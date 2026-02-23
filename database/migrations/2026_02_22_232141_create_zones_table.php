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
    Schema::create('zones', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('wilaya', 100);
        $table->string('commune', 100);
        $table->string('quartier', 100)->nullable();

        $table->unique(['wilaya', 'commune', 'quartier'], 'uk_zone');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
};
