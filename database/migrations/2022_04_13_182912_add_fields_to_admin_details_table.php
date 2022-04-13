<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAdminDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_details', function (Blueprint $table) {
            $table->integer('district_id')->nullable()->after('id');
            $table->integer('upazilla_id')->nullable()->after('district_id');
            $table->integer('union_id')->nullable()->after('upazilla_id');
            $table->integer('roll')->after('union_id');
            $table->string('name')->after('roll');
            $table->string('email')->after('name');
            $table->string('password')->after('gender');
            $table->string('status')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_details', function (Blueprint $table) {
            $table->dropColumn(['district_id','upazilla_id','union_id','roll','name','email','password','status']);
        });
    }
}
