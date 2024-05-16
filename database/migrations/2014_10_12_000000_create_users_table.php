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
            $table->uuid('id')->primary(); // Change the primary key to UUID

            $table->string('name');
            //avatar
            $table->string('avatar')->default("https://res.cloudinary.com/demo/image/facebook/w_100,h_100,c_fill,d_avatar2.png/non_existing_id.jpg");
            $table->string('email')->nullable()->unique();
            //phone
            $table->string('phone')->unique()->nullable();
            //country code
            $table->string('country_code')->default("+20");
            //lang
            $table->string('lang')->default('en');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            #user type
            $table->string('user_type')->default("USER");

            $table->string('email_verification_token')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=> Active , 1=> inactive');

            // //balance
            // $table->decimal('balance', 10, 2)->default(0.00);
            // //currency
            // $table->string('currency')->default('EGP');
            $table->unsignedTinyInteger('active')->default('1')->comment('0 => inactive, 1 => active');

            //api_token
            $table->string('api_token', 80)->unique()->nullable()->default(null);

            $table->softDeletes(); // Adds 'deleted_at' column

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
