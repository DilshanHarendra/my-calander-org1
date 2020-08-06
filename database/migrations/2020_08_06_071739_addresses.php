<?php

use App\Enums\CalendarType;
use App\Enums\WeekDays;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('full_address');
            $table->string('street_1');
            $table->string('street_2')->nullable()->default(null);
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('addressable_id');
            $table->string('addressable_type');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('addresses');
        Schema::enableForeignKeyConstraints();
    }
}
