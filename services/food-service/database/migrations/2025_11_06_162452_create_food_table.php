<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('carbs', 5, 2)->default(0);
            $table->decimal('sugar', 5, 2)->default(0);
            $table->boolean('gluten')->default(false);
            $table->boolean('nuts')->default(false);
            $table->boolean('dairy')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('foods');
    }
};