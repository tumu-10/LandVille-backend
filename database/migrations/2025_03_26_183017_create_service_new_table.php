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
        Schema::create('service_new', function (Blueprint $table) {
            $table->id();
            $table->string('services_title');
            $table->text('services_desc');
            $table->json('sub_services'); // Store sub-services as a JSON array
            $table->string('services_img')->nullable(); // Optional field for image
            $table->string('services_video')->nullable(); // Optional field for video
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
        Schema::dropIfExists('service_new');
    }
};
