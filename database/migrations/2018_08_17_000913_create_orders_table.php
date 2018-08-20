<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_address_id')->nullable();
            $table->unsignedInteger('kit_id');
            $table->unsignedInteger('status_id')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedInteger('invoice_number');
            $table->date('invoice_issue_date');
            $table->string('sales_executive')->nullable();
            $table->unsignedInteger('hardware_order_number')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('user_address_id')
                ->references('id')
                ->on('user_addresses')
                ->onDelete('set null');

            $table->foreign('kit_id')
                ->references('id')
                ->on('kits')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('order_statuses')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
