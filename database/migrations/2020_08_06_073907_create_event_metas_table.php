<?php

use App\Enums\CalendarType;
use App\Enums\WeekDays;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('value');

            $table->unsignedBigInteger('event_id');

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('event_metas');
        Schema::enableForeignKeyConstraints();
    }
}
