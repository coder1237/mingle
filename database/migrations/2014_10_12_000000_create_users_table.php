<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('google_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dob')->comment('Birth date');
            $table->decimal('annual_income', 12, 2)->comment('annual income');
            $table->string('gender')->default('male');
            $table->string('occupation')->nullable();
            $table->string('family_type')->nullable();
            $table->boolean('manglik')->default(false);
            $table->decimal('pre_min_income', 12, 2)->default(0.00)
                ->comment('Preference min income');
            $table->decimal('pre_max_income', 12, 2)->default(0.00)
                ->comment('Preference max income');
            $table->string('pre_occupation')->nullable()->comment('Preference occupation');
            $table->string('pre_family_type')->nullable()->comment('Preference family type');
            $table->string('pre_manglik')->nullable()->comment('Preference manglik');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
