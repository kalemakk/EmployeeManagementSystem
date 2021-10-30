<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('location');
            $table->string('email')->unique();
            $table->text('password')->nullable();
            $table->dateTime('joined');
            $table->foreignId('branch')->nullable()->constrained('branches');
            $table->text('employee_id')->nullable();
            $table->enum('status',['active','pending','left'])->default('active');
            $table->foreignId('department_id')->constrained('departments');
            $table->string('position');
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
        Schema::dropIfExists('employees');
    }
}
