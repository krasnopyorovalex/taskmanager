<?php

use Domain\Task\Entities\TaskStatus;
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
        Schema::create('tasks', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('performer_id')->nullable();

            $table->char('uuid', 36)->unique();

            $table->string('name', 255);
            $table->text('body');
            $table->enum('status', (new TaskStatus())->toArray())->default('NEW');
            $table->date('deadline')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->index(['author_id']);
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //$table->index(['performer_id']);
            $table->foreign('performer_id')
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
        Schema::dropIfExists('tasks', static function (Blueprint $table) {
            $table->dropForeign(['initiator_id','developer_id']);
        });
    }
}
