<?php

namespace App\Jobs;

use App\Models\Pedidos_Brinde;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailConfirmacaoCompra implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;
    private $pedidos_Brinde;
    /** 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pedidos_Brinde $pedidos_Brinde)
    {
        //
        $this->pedidos_Brinde = $pedidos_Brinde;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        
        Mail::send(new \App\Mail\EmailConfirmacaoCompra($this->pedidos_Brinde));

    }
}
