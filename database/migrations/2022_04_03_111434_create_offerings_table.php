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
        Schema::create('offerings', function (Blueprint $table) {

            $table->id();
            $table->string("memberName");
            $table->float("amount");
            $table->string("phone");
            $table->date("date");
            $table->string("reason");
            $table->foreignId('admin_id')
                            ->constrained()
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerings');
    }
};