<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateCotas implements ShouldQueue
{
    use Queueable;

    private $product_id;
    private $cota_number;
    private $cota_limit;
    private $active;
    private $connectiondb;
    private $tenant_id;
    private $token;

    public function __construct($connectiondb, $product_id, $cota_number, $cota_limit, $active, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->cota_number = $cota_number;
        $this->cota_limit = $cota_limit;
        $this->active = $active;
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

        DB::connection($connectiondb)->table("cotas_premiadas")
            ->where('product_id', $this->product_id)
            ->where('cota_number', $this->cota_number)
            ->update([
                'cota_limit' => $this->cota_limit ?? null,
                'active' => $this->active ?? null,
            ]);

        /*CotasPremiada::on($this->connectiondb)
            ->update([
                'cota_limit' => $this->cota_limit ?? null,
                'active' => $this->active ?? null,
            ]);*/
    }
}
