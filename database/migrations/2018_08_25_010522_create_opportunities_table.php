<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->text('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('is_volunteer_limit')->default(0)->nullable();
            $table->string('number_of_volunteer')->nullable();
            $table->string('detail')->nullable();
            $table->string('number_of_student')->nullable();
            $table->boolean('is_call')->default(0)->nullable();
            $table->boolean('subject1')->default(0)->nullable();
            $table->boolean('subject2')->default(0)->nullable();
            $table->boolean('subject3')->default(0)->nullable();
            $table->boolean('subject4')->default(0)->nullable();
            $table->boolean('subject5')->default(0)->nullable();
            $table->boolean('subject6')->default(0)->nullable();
            $table->boolean('subject7')->default(0)->nullable();
            $table->boolean('subject8')->default(0)->nullable();
            $table->boolean('is_published')->default(0)->nullable();
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
        Schema::drop('opportunities');
    }
}
