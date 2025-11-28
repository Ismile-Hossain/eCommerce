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
            $table->id();                                      // Primary key
            $table->string('name');                            // Full name
            $table->string('email')->unique();                 // Unique email
            $table->string('mobile')->nullable();              // Optional phone
            $table->timestamp('email_verified_at')->nullable();// Email verification timestamp
            $table->string('password');                        // Password (hashed)
            $table->boolean('is_active')->default(true);       // User status, default active
            $table->boolean('is_admin')->default(false);       // Admin flag
            $table->rememberToken();                           // "remember me" token
            $table->timestamps();                              // created_at & updated_at
            $table->softDeletes();                             // Adds deleted_at for safe deleting
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
