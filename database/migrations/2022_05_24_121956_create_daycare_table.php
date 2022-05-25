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
            $table->string("name");
            $table->string("npsn");
            $table->string("educational_stage");
            $table->enum('status', ['negeri', 'swasta']);
            $table->text("address");
            $table->integer("rt")->default(0);
            $table->integer("rw")->default(0);
            $table->string("postcode");
            $table->string("district");
            $table->string("subdistrict");
            $table->string("city");
            $table->string("province");
            $table->string("country");
            $table->string("latitude");
            $table->string("longitude");

            // Additional Data
            $table->string("establishment_number")->nullable();
            $table->dateTime("establishment_date")->nullable();
            $table->string("ownership_status");
            $table->string("operational_permission_number")->nullable();
            $table->dateTime("operational_permission_date")->nullable();
            $table->boolean("is_accept_handicap")->default(false);
            $table->string("bank_number")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("bank_branch")->nullable();
            $table->string("bank_owner_name")->nullable();
            $table->boolean("is_mbs")->default(false);
            $table->double("land_ownership_area");
            $table->double("land_not_ownership_area");
            $table->string("npwp");
            $table->string("npwp_owner_name");

            // Contact
            $table->string("phone_number")->nullable();
            $table->string("fax_number")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();

            // Periodic Data
            $table->integer("active_hour");
            $table->boolean("is_accept_bos")->default(false);
            $table->string("is_iso_certification")->nullable();
            $table->string("power_resource");
            $table->integer("watt");
            $table->string("internet_provider")->nullable();
            $table->string("alt_internet_provider")->nullable();

            // Additional Data
            $table->string("headmaster");
            $table->string("administrator");
            $table->string("acreditation")->nullable();
            $table->string("curriculum");
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
