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
        Schema::create('employees', function (Blueprint $table) {
            $table->string("employee_id");
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string("first_name");
            $table->string("last_name");
            $table->string("contact_number");
            $table->string("email_address");
            $table->string("date_of_birth");
            $table->string("street_address");
            $table->string("city");
            $table->string("postal_code");
            $table->string("country");
            $table->string("skill_1")->nullable();
            $table->string("years_of_exp_1")->nullable();
            $table->string("seniority_rating_1")->nullable();
            $table->string("skill_2")->nullable();
            $table->string("years_of_exp_2")->nullable();
            $table->string("seniority_rating_2")->nullable();
            $table->string("skill_3")->nullable();
            $table->string("years_of_exp_3")->nullable();
            $table->string("seniority_rating_3")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
