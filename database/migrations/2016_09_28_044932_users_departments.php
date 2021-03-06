<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_departments', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('userId')->unsigned()->index();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');

            $table->integer('departmentId')->unsigned()->index();
            $table->foreign('departmentId')->references('id')->on('departments')->onDelete('cascade');

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
        Schema::drop('users_departments');
    }
}
