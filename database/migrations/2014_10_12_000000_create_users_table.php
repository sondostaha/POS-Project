<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username');
            $table->longtext('about')->nullable();
            $table->string('phone')->nullable();
            $table->string('wphone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('pay')->nullable();
            $table->string('vcashe')->nullable();
            $table->string('card')->nullable();
            $table->string('password');
            $table->string('role')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
            $table->foreignId('new_franchise_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');

            
            $table->timestamps();
        });

       $user = User::create([
            'name' => 'yousef',
            'email' => 'jooyehia611@gmail.com',
            'username' => 'superadmin',
            'about' => 'مبرمج',
            'phone' => '01123223217',
            'wphone' => '01123223217',
            'facebook' => 'joo',
            'pay' => 'vcash',
            'vcashe' => '01141441436',
            'card' => '54354564556',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

              // Assign role to user
              $role = Role::where('name', 'المدير التنفيذي')->first();
              $user->assignRole($role);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
