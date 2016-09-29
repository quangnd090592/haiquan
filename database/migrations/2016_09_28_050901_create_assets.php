<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('years');
            // $table->string('price');
            // $table->string('clientNumber');
            $table->longText('notes')->nullable();
            $table->string('location')->nullable();
            $table->string('win')->nullable();
            $table->string('office')->nullable();
            $table->string('ie')->nullable();
            $table->string('status')->nullable();
            $table->string('port')->nullable();

            $table->integer('assetType_id')->unsigned();
            $table->foreign('assetType_id')->references('id')->on('asset_types')
                  ->onUpdate('cascade');

            $table->integer('producer_id')->unsigned();
            $table->foreign('producer_id')->references('id')->on('producers')
                  ->onUpdate('cascade');

            $table->integer('department_id');
            $table->integer('user_id');

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
        Schema::drop('assets');
    }
}
