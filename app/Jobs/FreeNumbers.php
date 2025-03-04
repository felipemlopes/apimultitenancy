<?php

namespace App\Jobs;

use App\Models\OrderList;
use App\Models\ProductList;
use App\Services\OrderListService;
use App\Services\ProductListService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FreeNumbers implements ShouldQueue
{
    use Queueable;

    private $token;
    private $tenant_id;

    /**
     * Create a new job instance.
     */
    public function __construct($token,$tenant_id)
    {
        $this->token = $token;
        $this->tenant_id = $tenant_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);

        // Obtém todos os IDs de produtos
        $productIds = DB::connection($connectiondb)->table("product_list")->where('status', 1)
            ->orWhere(function ($query) {
                $query->where('status', 3)
                    ->whereRaw('NOW() < DATE_ADD(date_updated, INTERVAL 24 HOUR)');
            })
            ->pluck('id')
            ->toArray();

        foreach ($productIds as $productId) {
            // Para cada produto, obtemos as ordens expiradas
            $expiredOrderIds = DB::connection($connectiondb)->table("order_list")
                ->where("product_id",$productId)->whereIn("status",[0,1])
                ->whereDate("date_created","<",Carbon::now()->format("Y-m-d H:i"))->get();

            foreach ($expiredOrderIds as $order) {
                // Para cada ordem, obtemos os números da ordem
                $result = DB::connection($connectiondb)->table("order_list")->select("order_numbers")
                    ->where("product_id",$productId)->where("id",$order->id)->get();

                $numbers = $result ? $result[0]->order_numbers : "";

                // Processa os números da ordem
                dispatch(new BackNumbers($connectiondb, $productId, $numbers,$this->tenant_id,$this->token));

                // Atualiza o status da ordem para cancelado
                $status = 3;
                DB::connection($connectiondb)->table("order_list")->where("id",$order->id)->update(["status"=>$status]);
            }

            // Atualiza os números pendentes para o produto
            $pendingNumbers = DB::connection($connectiondb)->table("order_list")->where('product_id', $productId)
                ->whereIn('status', [0, 1])
                ->whereNotNull('order_numbers')
                ->sum('quantity') ?? 0;;
            DB::connection($connectiondb)->table("product_list")->where('id', $productId)
                ->update(['pending_numbers' => $pendingNumbers]);
        }
    }
}
