<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use Session;

class CarritoController extends Controller
{
    public function __construct()
    {
        if (!Session::has('carrito')) 
                Session::put('carrito', array());
        
    }

    public function add($id){
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);

        $producto->cantidad = 1;

        $carrito[$producto->id]= $producto;
        Session::put('carrito', $carrito); 
        //return Session::get('carrito');
        return redirect()->route('carrito');
    }

    public function trash()
    {
        Session::forget('carrito');
        return redirect()->route('carrito');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardarPedido()
    {
        $carrito = Session::get('carrito');
        if(count($carrito)){
            $now = new \DateTime();
            $numero = $now->format('Ymd-His');
            foreach($carrito as $producto){
                $this->guardarItem($producto, $numero);
            }
             Session::forget('carrito');
             $mensaje = 'Pedido realizado con éxito';

            }
            return redirect()->route('carrito')->with('mensaje', $mensaje);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function guardarItem($producto, $numero)
    {
        $productoguardado = Pedido::create([
            'numero'=>$numero,
            'idproducto'=>$producto->id,
            'cantidad'=> $producto->cantidad,
            'precio'=>$producto->precio
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $carrito = Session::get('carrito');
        //return $carrito;
        $total = $this->total();
        return view('carrito.carrito', compact('carrito', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function total()
    {
        $carrito = Session::get('carrito');
        $total=0;
        foreach($carrito as $item){
            $total +=$item->precio*$item->cantidad;
        }
        return $total;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $cantidad)
    {
        $carrito =Session::get('carrito');
        $producto= Producto::find($id);
        $carrito[$producto->id]->cantidad= $cantidad;
        Session::put('carrito',$carrito);
        return redirect()->route('carrito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $carrito = Session::get('carrito');
        unset($carrito[$id]);
        Session::put('carrito',$carrito);
        return redirect()->route('carrito');
    }
}
