<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinformations', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('sex');
            $table->string('email');
            $table->date('date_received');
            $table->date('date_emailed');
            $table->string('mode_of_communication');
            $table->string('nature_of_concern');
            $table->string('actual_inquiry');
            $table->string('recommendation');
            $table->string('person_in_charge');
            $table->string('status');
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
        Schema::dropIfExists('userinformations');
    }
};
