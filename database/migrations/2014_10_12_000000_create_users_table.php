<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('userName')->nullable();
            $table->string('email')->nullable();
            $table->string('password', 128)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('nickName', 128)->nullable();
            $table->string('hash', 64)->nullable();
            $table->integer('companyId')->default(0)->comment('id FROM companies');
            $table->tinyInteger('isCompanyOwner')->default(0)->comment('0=no;1=yes');
            $table->dateTime('lastActivity')->nullable();
            $table->string('userProfileImage',128)->nullable();
            $table->string('userProfileThumb',128)->nullable();
            $table->tinyInteger('activated')->default(0)->comment('1=yes;0=no');
            $table->tinyInteger('verified')->default(0)->comment('1=yes;0=no');
            $table->tinyInteger('userStatus')->default(1)->comment('0=inactive;1=active;-1=deleted');
            $table->tinyInteger('agreeTNC')->default(1)->comment('agree terms & conditions');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
