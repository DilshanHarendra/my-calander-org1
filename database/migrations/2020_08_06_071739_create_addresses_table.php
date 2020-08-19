<?php

use App\Enums\CalendarType;
use App\Enums\WeekDays;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateAddressesTable extends Migration
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
            $table->string('place_id')->nullable()->default(null);
            $table->string('full_address')->nullable()->default(null);
            $table->string('street')->nullable()->default(null);
            $table->string('street_no')->nullable()->default(null);
            $table->string('floor')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->string('latitude')->nullable()->default(null);
            $table->string('postal_code')->nullable()->default(null);
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
