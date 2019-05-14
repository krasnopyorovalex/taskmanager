<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('body');
            $table->enum('status',[
                'NEW',
                'IN_WORK',
                'PAUSED',
                'COMPLETED',
                'RETURNED',
                'CLOSED'
            ])->default('NEW');
            $table->unsignedInteger('initiator_id');
            $table->unsignedInteger('developer_id');
            $table->timestamp('deadline')->nullable();
            $table->timestamps();
            $table->timestamp('closed_at', 0)->nullable();

            $table->index(['initiator_id']);
            $table->foreign('initiator_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->index(['developer_id']);
            $table->foreign('developer_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('tasks', function (Blueprint $table) {
            $table->dropForeign(['initiator_id','developer_id']);
        });
    }
}
