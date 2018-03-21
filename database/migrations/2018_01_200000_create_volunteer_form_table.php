<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VolunteerFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('organization_name');
            $table->string('email');
            $table->string('phone');
            $table->text('meal_description');
            $table->text('notes');
            $table->boolean('paper_goods');
            $table->smallInteger('form_status')->nullable()->comment('0=new,1=confirmed,2=rejected');
            $table->string('open_event_id');
            $table->dateTime('event_date_time')->nullable();
            $table->string('confirmed_event_id')->nullable();
            $table->timestamps();
            $table->unique('confirmed_event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_forms');
    }
}
