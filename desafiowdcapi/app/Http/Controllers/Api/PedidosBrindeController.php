<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\EmailConfirmacaoCompra;
use App\Models\Pedidos_Brinde;
use Illuminate\Http\Request;

class PedidosBrindeController extends Controller    
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pedidos_Brinde::all();
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedidos_Brinde = Pedidos_Brinde::where('email','=',$request->email)->first();
        if($pedidos_Brinde){
            return response()->json('Seu pedido de brinde ja foi enviado por favor verfique seu email',200);
        }else{
            $novo_pedido = new Pedidos_Brinde;
            $novo_pedido->email = $request->email;
            
            if($novo_pedido->save()){
                \App\Jobs\EmailConfirmacaoCompra::dispatch($request->email)->delay(now());
                return response()->json('Acabamos de receber seu pedido verifique seu email para preencer as infromações de
                envio',200);
            }else{
               return response()->json('Erro ao registrar seu pedido pro favor tente novamente',200);
            }
             
        }

      
    }
  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedidos_Brinde  $pedidos_Brinde
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Pedidos_Brinde::find($id);
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedidos_Brinde  $pedidos_Brinde
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $pedidos_Brinde = Pedidos_Brinde::findOrFail($id);
        if ($pedidos_Brinde) {
            $pedidos_Brinde->update($request->all());
            return $pedidos_Brinde;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedidos_Brinde  $pedidos_Brinde
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos_Brinde $pedidos_Brinde)
    {
        //
    }
}
