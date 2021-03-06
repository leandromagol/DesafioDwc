<?php

namespace App\Mail;

use App\Models\Pedidos_Brinde;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmacaoCompra extends Mailable
{
    use Queueable, SerializesModels;

    private $pedidos_Brinde;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedidos_Brinde $pedidos_Brinde)
    {
        //
        $this->pedidos_Brinde = $pedidos_Brinde;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->to($this->pedidos_Brinde->email,$this->pedidos_Brinde->email);
        return $this->markdown('Mail.EmailConfirmacaoCompra',['token'=>$this->pedidos_Brinde->token]);
    }
}
