<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('user_statuses')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('contact');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('security_question')->nullable();
            $table->string('answer')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $users = [
            [
                'username' => 'admin',
                'fname' => 'Admin',
                'lname' => 'Admin',
                'email' => 'admin@gmail.com',
                'contact' => '+639586693044',
                'password' => Hash::make('password'),
                'status' => 'Active',
                'security_question' => 'Whats your favorite color?',
                'answer' => 'Red',
                'role_id' => 1,
                'status_id' => 1,
            ],
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
