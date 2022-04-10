<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('designation')->nullable()->after('phone');
            $table->string('depertment')->nullable()->after('designation');
            $table->string('address')->nullable()->after('depertment');
            $table->string('api_token')->nullable()->after('address');
            $table->string('status')->default(0)->after('api_token');
            $table->string('added_by')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone','designation','depertment','address','status','added_by']);
        });
    }
}
