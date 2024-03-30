<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('rental_id');
        $table->date('return_date');
        $table->integer('rented_days');
        $table->decimal('total_cost', 10, 2);
        $table->timestamps();

    $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}
