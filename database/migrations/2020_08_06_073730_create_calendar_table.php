<?php

use App\Enums\CalendarType;
use App\Enums\WeekDays;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('first_day')->default(WeekDays::Monday);
            $table->string('type')->default(CalendarType::NormalCalendar);
            $table->string('time_zone');
            $table->string('owner_email')->index();

            $table->unsignedBigInteger('accounts_id');

            $table->foreign('accounts_id')->references('id')->on('accounts')->onDelete('cascade');
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
        Schema::dropIfExists('calendars');
        Schema::enableForeignKeyConstraints();
    }
}
