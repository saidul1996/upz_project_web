<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('address');
            $table->text('short_description')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // Insert row
        DB::table('site_settings')->insert([
            ["id" => "1","name" => "Website Title","phone" => "01XXXXXXXXX","email" => "info@example.com","website" => "www.example.com","address" => "Zigatala, Dhanmondi, Dhaka-1209", "short_description" => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
