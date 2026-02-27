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
    Schema::create('audit_logs', function (Blueprint $table) {
        $table->uuid('id')->primary();

        // ✅ users.id = bigint
        $table->unsignedBigInteger('actor_user_id');

        $table->string('action', 80);
        $table->string('entity_type', 80);

        // entity_id dépend: si tes entités sont uuid => garde uuid
        $table->uuid('entity_id');

        $table->json('old_value')->nullable();
        $table->json('new_value')->nullable();

        $table->dateTime('created_at')->useCurrent();

        $table->index('actor_user_id', 'fk_audit_user');
        $table->index(['entity_type','entity_id'], 'idx_audit_entity');

        // ✅ FK correcte
        $table->foreign('actor_user_id')->references('id')->on('users')->cascadeOnDelete();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
