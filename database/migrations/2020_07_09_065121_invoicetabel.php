<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoicetabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invocie', function (Blueprint $table) {
            $table->id();
            $table->string('InvoiceNo');
            $table->string('InvoiceDate');
            $table->string('Receivername');
            $table->string('InvoiceTotal');
            $table->string('invoiceDetails');
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
        Schema::dropIfExists('invocie');
    }
}
