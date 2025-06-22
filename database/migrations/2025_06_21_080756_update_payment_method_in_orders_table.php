<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdatePaymentMethodInOrdersTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY payment_method ENUM('cod', 'paypal', 'midtrans') DEFAULT 'cod'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY payment_method ENUM('cod', 'paypal') DEFAULT 'cod'");
    }
}

