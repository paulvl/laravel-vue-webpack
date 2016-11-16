<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('date');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('quotation_state_id');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('quotation_state_id')
                ->references('id')
                ->on('quotation_states');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
