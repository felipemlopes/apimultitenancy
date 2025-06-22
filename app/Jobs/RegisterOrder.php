<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterOrder implements ShouldQueue
{
    use Queueable;

    private $connectiondb;
    private $customer;
    private $product;
    private $cartData;
    private $orderId;
    private $code;
    private $totalAmount;
    private $discountAmount;
    private null $affiliate;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb, $customer, $product, $cartData, $orderId, $code, $totalAmount, $discountAmount, $affiliate = null)
    {
        $this->connectiondb = $connectiondb;
        $this->customer = $customer;
        $this->product = $product;
        $this->cartData = $cartData;
        $this->orderId = $orderId;
        $this->code = $code;
        $this->totalAmount = $totalAmount;
        $this->discountAmount = $discountAmount;
        $this->affiliate = $affiliate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $startTime = microtime(true);

        DB::connection($this->connectiondb)->beginTransaction();

        try {
            // Atualiza o pedido
            DB::connection($this->connectiondb)->table('order_list')
                ->where('id', $this->orderId)
                ->update([
                    'total_amount'    => $this->totalAmount,
                    'discount_amount' => $this->discountAmount,
                    'date_updated'      => Carbon::now(),
                ]);

            // Busca o carrinho do cliente com base no código
            $code = $this->code;
            $cart = DB::connection($this->connectiondb)->table('cart_list as c')
                ->join('product_list as p', 'c.product_id', '=', 'p.id')
                ->leftJoin('order_list as o', function ($join) use ($code) {
                    $join->on('c.product_id', '=', 'o.product_id')
                        ->where('o.code', '=', $code);
                })
                ->where('c.customer_id', $this->customer->id)
                ->select('c.*', 'p.name as product', 'p.price', 'p.image_path', 'o.order_numbers')
                ->get();

            /*$cart = DB::connection($this->connectiondb)->table('cart_list')
                ->where('customer_id', $this->customer->id)
                ->where('code', $this->code)
                ->get();*/

            Log::info("cart items");
            Log::info($cart);

            Log::info("cart");
            Log::info(json_encode($cart));
            // Insere os itens do carrinho no pedido
            foreach ($cart as $item) {
                Log::info(json_encode($item));
                $result = DB::connection($this->connectiondb)->table('order_items')->insert([
                    'order_id'   => $this->orderId,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ]);

                Log::info("Item inserido: ", ['result' => $result]);
            }

            DB::connection($this->connectiondb)->commit();

            Log::info("Tempo para registrar pedido: " . (microtime(true) - $startTime) . " segundos");
        } catch (\Exception $e) {
            DB::connection($this->connectiondb)->rollBack();
            Log::error("Erro ao registrar pedido: " . $e->getMessage());
            throw $e;
        }
    }
}
