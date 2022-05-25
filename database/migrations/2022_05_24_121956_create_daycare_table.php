<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaycareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daycare', function (Blueprint $table) {
            $table->id();
            // School indentity
            $table->string("name")->nullable();
            $table->string("npsn")->nullable();
            $table->string("educational_stage")->nullable();
            $table->string('status')->nullable();
            $table->text("address")->nullable();
            $table->string("rt")->nullable();
            $table->string("rw")->nullable();
            $table->string("postcode")->nullable();
            $table->string("district")->nullable();
            $table->string("subdistrict")->nullable();
            $table->string("city")->nullable();
            $table->string("province")->nullable();
            $table->string("country")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();

            // Additional Data
            $table->string("establishment_number")->nullable();
            $table->string("establishment_date")->nullable();
            $table->string("ownership_status")->nullable();
            $table->string("operational_permission_number")->nullable();
            $table->string("operational_permission_date")->nullable();
            $table->string("is_accept_handicap")->nullable();
            $table->string("bank_number")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("bank_branch")->nullable();
            $table->string("bank_owner_name")->nullable();
            $table->string("is_mbs")->nullable();
            $table->string("land_ownership_area")->nullable();
            $table->string("land_not_ownership_area")->nullable();
            $table->string("npwp")->nullable();
            $table->string("npwp_owner_name")->nullable();

            // Contact
            $table->string("phone_number")->nullable();
            $table->string("fax_number")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();

            // Periodic Data
            $table->string("active_hour")->nullable();
            $table->string("is_accept_bos")->nullable();
            $table->string("is_iso_certification")->nullable();
            $table->string("power_resource")->nullable();
            $table->string("watt")->nullable();
            $table->string("internet_provider")->nullable();
            $table->string("alt_internet_provider")->nullable();

            // Additional Data
            $table->string("headmaster")->nullable();
            $table->string("administrator")->nullable();
            $table->string("acreditation")->nullable();
            $table->string("curriculum")->nullable();
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
        Schema::dropIfExists('daycare');
    }
}
