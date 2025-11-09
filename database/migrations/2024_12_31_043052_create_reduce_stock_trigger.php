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
        // Membuat trigger untuk mengurangi stok produk setelah order
        DB::unprepared('
            CREATE TRIGGER reduce_stock_after_order
            AFTER INSERT ON order_details
            FOR EACH ROW
            BEGIN
                -- Mengurangi stok produk berdasarkan `product_id` dan jumlah `quantity` yang dipesan
                UPDATE products
                SET stock = stock - NEW.quantity
                WHERE product_id = NEW.product_id;

                -- Pastikan stok tidak negatif
                IF (SELECT stock FROM products WHERE product_id = NEW.product_id) < 0 THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Stock tidak mencukupi!";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus trigger jika diperlukan rollback
        DB::unprepared('DROP TRIGGER IF EXISTS reduce_stock_after_order');
    }
};
