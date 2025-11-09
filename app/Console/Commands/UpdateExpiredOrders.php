<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\orders;
use Carbon\Carbon;

class UpdateExpiredOrders extends Command
{
    protected $signature = 'orders:update-expired';

    protected $description = 'Update pesanan: jika "dikonfirmasi" > 7 hari, atau "dp" > 14 hari maka menjadi "batal"';

    public function handle()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $twoWeeksAgo = Carbon::now()->subDays(14);

        // Pesanan status 'dikonfirmasi' lebih dari 7 hari
        $expiredConfirmedOrders = orders::where('status', 'dikonfirmasi')
            ->where('order_date', '<', $sevenDaysAgo)
            ->get();

        // Pesanan status 'dp' lebih dari 14 hari
        $expiredDpOrders = orders::where('status', 'dp')
            ->where('order_date', '<', $twoWeeksAgo)
            ->get();

        $totalExpired = $expiredConfirmedOrders->count() + $expiredDpOrders->count();
        $this->info("Ditemukan total $totalExpired pesanan yang kadaluarsa dan akan diupdate.");

        // Proses pesanan 'dikonfirmasi'
        foreach ($expiredConfirmedOrders as $order) {
            $this->info("Order ID {$order->order_id} (status: dikonfirmasi) diubah menjadi batal.");
            $order->status = 'batal';
            $order->save();
        }

        // Proses pesanan 'dp'
        foreach ($expiredDpOrders as $order) {
            $this->info("Order ID {$order->order_id} (status: dp) diubah menjadi batal.");
            $order->status = 'batal';
            $order->save();
        }

        $this->info("Proses update pesanan selesai.");
    }
}
