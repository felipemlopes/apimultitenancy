<?php

namespace App\Jobs;

use App\Models\OrderList;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlaceOrder implements ShouldQueue
{
    use Queueable;

    private $customer_id;
    private $product_id;
    private $order_id;
    private $code;
    private $upersell;
    private $connectiondb;
    private $endpoint;


    public function __construct($connectiondb, $customer_id, $product_id, $order_id, $code, $upersell,$endpoint)
    {
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->order_id = $order_id;
        $this->code = $code;
        $this->upersell = $upersell;
        $this->connectiondb = $connectiondb;
        $this->endpoint = $endpoint;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url =  $this->endpoint. "/classes/Master.php?f=place_order";

        Log::info($url);
        Log::info($this->customer_id);
        Log::info($this->product_id);
        Log::info($this->order_id);
        Log::info($this->code);

        $response = Http::post($url, [
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'order_id' => $this->order_id,
            'code' => $this->code
        ]);

        $result = $response->json();
        $this->markOrderAsError($this->order_id);
        if ($response->failed()) {
            //Log::error("Erro ao criar place order: " . $result['error']);
            Log::error("Erro ao criar place order: ");
            $this->markOrderAsError($this->order_id);
        } else {
            Log::info("Place order criado com sucesso.");
        }
    }

    /**
     * @throws Exception
     */
    private function markOrderAsError($order_id)
    {
        $recordsAffected = DB::connection($this->connectiondb)->table("order_list")
            ->where('id', $order_id)
            ->update(['status' => 4]);
        /* = OrderList::on($this->connectiondb)
            ->where('id', $order_id)
            ->update(['status' => 4]);*/

        if ($recordsAffected === 0) {
            throw new Exception("Updating DB when marking order as error did not work.");
        }
    }
}
