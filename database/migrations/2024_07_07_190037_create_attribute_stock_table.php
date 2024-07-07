<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attribute_stock', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attribute_id')->index()
                ->references('id')->on('attributes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('stock_id')->index()
                ->references('id')->on('stocks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('attribute_group_id')->index()
                ->references('id')->on('attribute_groups')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_stock');
    }
};
