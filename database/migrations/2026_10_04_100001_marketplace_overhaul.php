<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->text('description')->nullable()->after('location');
            // perbaiki typo lama ->uniqe() yang tidak pernah membuat index
            $table->unique('email');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->string('category')->default('Lainnya')->after('slug');
            $table->text('description')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            // order per toko: pembayaran transfer ke rekening toko ybs.
            $table->foreignId('store_id')->nullable()->after('user_id')
                ->constrained('stores')->cascadeOnDelete();
            $table->string('status')->default('menunggu_pembayaran')->after('store_id');
            $table->unsignedBigInteger('total')->default(0)->after('status');
            $table->string('recipient_name')->nullable()->after('total');
            $table->string('phone')->nullable()->after('recipient_name');
            $table->text('address')->nullable()->after('phone');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('price')->default(0)->after('amount');
            // payment_id tidak dipakai lagi (alamat kini melekat pada order)
            $table->dropConstrainedForeignId('payment_id');
        });
    }

    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn(['slug', 'description']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['slug', 'category']);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('store_id');
            $table->dropColumn(['status', 'total', 'recipient_name', 'phone', 'address']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->foreignId('payment_id')->nullable()->constrained('payments');
        });
    }
};
