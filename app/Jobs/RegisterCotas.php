<?php

namespace App\Jobs;

use App\Models\CotasPremiada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RegisterCotas implements ShouldQueue
{
    use Queueable;
    private $product_id;
    private $numbers;
    private $active;
    private $connectiondb;
    private $tenant_id;
    private $token;

    /**
     * Create a new job instance.
     */
    public function __construct($connectiondb, $product_id, $numbers, $active, $tenant_id, $token)
    {
        $this->product_id = $product_id;
        $this->numbers = $numbers;
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

        foreach ($this->numbers as $number) {
            DB::connection($connectiondb)->table("cotas_premiadas")->insert([
                'product_id' => $this->productId,
                'cota_number' => $number,
                'cota_limit' => 10000,
                'active' => $this->active,
            ]);
            /*CotasPremiada::on($this->connectiondb)->create([
                'product_id' => $this->productId,
                'cota_number' => $number,
                'cota_limit' => 10000,
                'active' => $this->active,
            ]);*/
        }
    }
}
