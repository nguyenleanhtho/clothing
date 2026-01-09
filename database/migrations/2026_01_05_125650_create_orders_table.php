<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->string('status')->default('pending'); // pending, shipping, completed...
        
        // // Nên lưu lại địa chỉ/sđt tại thời điểm đặt hàng (phòng khi user đổi địa chỉ sau này)
        // $table->string('shipping_address')->nullable(); 
        // $table->string('shipping_phone')->nullable();
        
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
