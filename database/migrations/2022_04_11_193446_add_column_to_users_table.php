<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_code')->nullable()->after('phone');
            $table->integer('user_type_id')->after('user_code');
            $table->integer('district_id')->after('user_type_id');
            $table->integer('upazilla_id')->after('district_id');
            $table->integer('union_id')->after('upazilla_id');
            $table->string('ward_no')->after('union_id');
            $table->string('holding_no')->nullable()->after('ward_no');
            $table->string('id_type_id')->nullable()->after('holding_no');
            $table->string('identity_no')->nullable()->after('id_type_id');
            $table->integer('parent_type_id')->nullable()->after('identity_no');
            $table->string('parent_name')->after('parent_type_id');
            $table->string('mother_name')->after('parent_name');
            $table->string('post_office_name')->nullable()->after('mother_name');
            $table->string('postal_code')->nullable()->after('post_office_name');
            $table->integer('house_type_id')->nullable()->after('postal_code');
            $table->string('floor_type')->nullable()->after('house_type_id');
            $table->string('floor_level')->nullable()->after('floor_type');
            $table->string('occupation')->nullable()->after('floor_level');
            $table->string('family_male_members')->nullable()->after('occupation');
            $table->string('family_female_members')->nullable()->after('family_male_members');
            $table->string('religion')->nullable()->after('family_female_members');
            $table->string('landless')->nullable()->after('religion');
            $table->string('sanitation')->nullable()->after('landless');
            $table->string('taxpayer_id')->nullable()->after('sanitation');
            $table->string('marital_status')->nullable()->after('taxpayer_id');
            $table->date('date_of_birth')->nullable()->after('marital_status');
            $table->string('gender')->nullable()->after('date_of_birth');
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
            $table->dropColumn(['user_code','user_type_id','district_id','upazilla_id','union_id','ward_no','holding_no','id_type_id','identity_no','parent_type_id','parent_name','mother_name','post_office_name','postal_code','house_type_id','floor_type','floor_level','occupation','family_male_members','family_female_members','religion','landless','sanitation','taxpayer_id','marital_status','date_of_birth','gender']);
        });
    }
}
