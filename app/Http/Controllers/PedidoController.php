<?php

namespace App\Http\Controllers;


use App\Models\Empada;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Models\PedidoEmpada;
use App\Models\Tamanho;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $tamanhos = Tamanho::all()->sortBy('tamanho');
        $empadas = Empada::all()->sortBy('empada');
        $pagamentos = Pagamento::all()->sortBy('pagamento');
        return view ('pedidos.create', compact('tamanhos', 'empadas', 'pagamentos'));
    }

    public function store(Request $request)
    {
        $input = $request->toArray();
        $idpedido = Pedido::create($input) ;
        foreach ($input['empadas'] as $empada){
            $item['id_pedido'] = $idpedido;
            $item['id_empada'] = $empada;
            PedidoEmpada::create($item);
        }
    }

    public function index()
    {
        return view('pedidos.index');
    }

    public function edit($id)
    {
        $pedido = Pedido::find($id);
        return view('pedidos.edit', compact('pedido'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->toArray();
        $pedido = Pedido::find($id);
        $pedido->fill($input);
        $pedido->save();
        return redirect()->route('pedidos.index')->with('sucesso', 'Status Alterado com Sucesso!');
    }
}
