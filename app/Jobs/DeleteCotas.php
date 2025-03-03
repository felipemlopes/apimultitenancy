<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteCotas implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $numbers;
    private $connectiondb;
    private $tenant_id;
    private $token;


    public function __construct($connectiondb,$product_id, $numbers, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
        $this->connectiondb = $connectiondb;
        $this->tenant_id = $tenant_id;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connectiondb = setupTenantConnectionByToken($this->token);
        foreach ($this->numbers as $number) {
            DB::connection($connectiondb)->table("cotas_premiadas")
                ->where("cota_number",$number)
                ->where("product_id",$this->product_id)->delete();
            /*CotasPremiada::on($this->connectiondb)->where("cota_number",$number)
                ->where("product_id",$this->product_id)->delete();*/
        }
    }
}
