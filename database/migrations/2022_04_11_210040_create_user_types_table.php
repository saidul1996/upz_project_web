<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('user_type_name');
            $table->string('status')->default('1');
            $table->integer('added_by')->nullable();
            $table->timestamps();
        });

        // Insert rows
        DB::table('user_types')->insert([
            ["id" => "1","user_type_name" => "Normal Holding"],
            ["id" => "2","user_type_name" => "Commercial Holding"],
            ["id" => "3","user_type_name" => "Shop Holding"],
            ["id" => "4","user_type_name" => "Official Holding"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
