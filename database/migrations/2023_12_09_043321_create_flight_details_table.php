<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_details', function (Blueprint $table) {
            // $table->string('details_id')->primary();;
            $table->id(); // This will auto-increment and serve as the primary key
            $table->string('mission_id'); 
            $table->string('detected_qr_code');
            $table->timestamp('detected_time');
            // $table->timestamps();

              // Add foreign key constraint
            $table->foreign('mission_id')->references('mission_id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_details');
    }
}
