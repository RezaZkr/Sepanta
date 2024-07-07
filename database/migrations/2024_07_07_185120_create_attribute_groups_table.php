<?php

use Database\Seeders\AttributeGroupSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedTinyInteger('select_type')->default(\App\Enums\AttributeGroupSelectTypeEnum::RADIO->value);
            $table->boolean('filterable')->default(true);
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => AttributeGroupSeeder::class,
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_groups');
    }
};
