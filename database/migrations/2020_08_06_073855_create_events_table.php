<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('timezone');
            $table->boolean('all_day')->default(false);
            $table->boolean('remindable')->default(false);
            $table->boolean('is_canceled')->default(false);
            $table->boolean('is_draft')->default(false);
            $table->boolean('is_online')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->boolean('is_public')->default(true);

            $table->dateTime('end_of_recurring')->nullable()->default(null);

            $table->string('creator_email')->index();

            $table->unsignedBigInteger('cover_image_id')->nullable()->default(null);
            $table->unsignedBigInteger('calendar_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
            $table->foreign('cover_image_id')->references('id')->on('files')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('events');
        Schema::enableForeignKeyConstraints();
    }
}
