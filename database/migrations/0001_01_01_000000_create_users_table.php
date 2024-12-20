<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('username')->unique();
            $table->string('First_name');
            $table->string('Middle_name')->nullable();
            $table->string('Last_name');
            $table->string('Contact_number')->nullable()->unique();
            $table->string('Driver_license_ID')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('usertype');
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

        DB::statement("
            CREATE TRIGGER superadmin_insert_check
            BEFORE INSERT ON users
            FOR EACH ROW
            BEGIN
                IF NEW.usertype = 'superadmin' AND 
                   (SELECT COUNT(*) FROM users WHERE usertype = 'superadmin') > 0 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Only one superadmin is allowed';
                END IF;
            END
        ");

        DB::statement("
            CREATE TRIGGER superadmin_update_check
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.usertype = 'superadmin' AND 
                   (SELECT COUNT(*) FROM users WHERE usertype = 'superadmin') > 0 AND
                   OLD.usertype != 'superadmin' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Only one superadmin is allowed';
                END IF;
            END
        ");
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
