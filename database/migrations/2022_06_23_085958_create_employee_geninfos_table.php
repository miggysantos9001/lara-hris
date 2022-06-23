<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeGeninfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_geninfos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->date('date_hired');
            $table->date('date_separated')->nullable();
            $table->integer('department_id');
            $table->integer('position_id');
            $table->integer('branch_id');
            $table->integer('category_id');
            $table->integer('status_id');
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
        Schema::dropIfExists('employee_geninfos');
    }
}
