<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string(column: 'phone_number');
            $table->string('store_name');
            $table->string('location');
            $table->string('country');
            $table->string('city');
            $table->string('user_image');
            $table->string('whatsapp');
            $table->bigInteger('age');
            $table->string('gender');
            $table->string('facebook');
            $table->string('logo')->nullable();
            $table->string('details')->nullable();
            $table->boolean('activated')->default(true);
            $table->string('cat1')->nullable();
            $table->string('cat2')->nullable();
            $table->string('cat3')->nullable();
            $table->string('cat4')->nullable();
            $table->string('cat5')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
