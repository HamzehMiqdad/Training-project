<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('details');
            $table->string('image')->nullable();
            $table->string('category');
            $table->string('subcategory');

            $table->string('code')->nullable();
            $table->integer('hits')->default(0);
            $table->integer('price')->nullable();
            $table->boolean('availabe_for_sale')->default(true);

            
            $table->string('cat1')->nullable();
            $table->string('cat2')->nullable();
            $table->string('cat3')->nullable();
            $table->string('cat4')->nullable();
            $table->string('cat5')->nullable();

            
            $table->foreignIdFor(model: User::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
