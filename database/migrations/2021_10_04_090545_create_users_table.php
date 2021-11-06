<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->text('name');
            $table->text('second_name');
            $table->date('date_nais');

            $table->string('mail')->unique();

            $table->string('pseudo')->unique();
            $table->text('password');
            $table->text('profil_img')->nullable();
            $table->text('profil_background')->nullable();

            $table->integer('admin')->nullable();
            $table->integer('isBan')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
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
}
