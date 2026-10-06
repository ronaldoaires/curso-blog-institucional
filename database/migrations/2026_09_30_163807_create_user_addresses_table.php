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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            
            // Cascade delete: when user is deleted, all addresses are deleted
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->comment('Owner user id, addresses are deleted with the user');
            
            $table->string('type', 30)->comment('Address type: home, work, etc.');
            $table->string('zip_code')->comment('Postal/ZIP code');
            $table->string('state', 2)->comment('State/Province');
            $table->string('city')->comment('City');
            $table->string('street')->comment('Street name');
            $table->string('number')->nullable()->comment('Street number');
            $table->string('complement')->nullable()->comment('Address complement');
            $table->string('neighborhood')->comment('Neighborhood');
            $table->boolean('is_active')->default(true)->comment('Whether the address is active');
            $table->boolean('is_primary')->default(false)->comment('Whether this is the primary address');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};