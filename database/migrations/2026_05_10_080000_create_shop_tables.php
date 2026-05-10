<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 14, 2);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('recipient_name');
            $table->text('address');
            $table->string('phone');
            $table->string('payment_method');
            $table->string('status')->default('Pending');
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 14, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 14, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
