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
    Schema::create('attachments', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('report_id');
        $table->enum('type', ['PHOTO'])->default('PHOTO');
        $table->string('url', 500);

        $table->dateTime('created_at')->useCurrent();

        $table->index('report_id', 'fk_att_rep');
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
        Schema::dropIfExists('attachments');
    }
};
