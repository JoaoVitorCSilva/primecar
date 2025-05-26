<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Veiculo::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("veiculo.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("veiculo.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-outline-danger btn-sm ml-2")><i class="fas fa-trash"></i></button>
                        </form>
                    ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('veiculos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('veiculos.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        
        $modelo = $request->post('modelo');
        $marca = $request->post('marca');
        $placa = $request->post('placa');
        $renavam = $request->post('renavam');
        $chassi = $request->post('chassi');
        $ano = $request->post('ano');
        $cor = $request->post('cor');
        $saldo = $request->post('saldo');
        $combustivel = $request->post('combustivel');
        $observacao = $request->post('observacao');
              

        $veiculo = new veiculo();

        $veiculo->modelo = $modelo;
        $veiculo->marca = $marca;
        $veiculo->placa = $placa;
        $veiculo->renavam = $renavam;
        $veiculo->chassi = $chassi;
        $veiculo->ano_fabricacao = $ano;
        $veiculo->cor = $cor;
        $veiculo->tipo_combustivel = $combustivel;
        $veiculo->saldo = $saldo;
        $veiculo->observacoes = $observacao;
        $veiculo->origin_user = $user->name;
        $veiculo->last_user = $user->name;
        $veiculo->save();


        return view('veiculos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = veiculo::find($id);

        $output = array(
            'edit' => $edit,
        );

        return view('veiculos.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $modelo = $request->post('modelo');
        $marca = $request->post('marca');
        $placa = $request->post('placa');
        $renavam = $request->post('renavam');
        $chassi = $request->post('chassi');
        $ano = $request->post('ano');
        $cor = $request->post('cor');
        $saldo = $request->post('saldo');
        $combustivel = $request->post('combustivel');
        $observacao = $request->post('observacao');

        $veiculo = veiculo::find($id);

        $veiculo->modelo = $modelo;
        $veiculo->marca = $marca;
        $veiculo->placa = $placa;
        $veiculo->renavam = $renavam;
        $veiculo->chassi = $chassi;
        $veiculo->ano_fabricacao = $ano;
        $veiculo->cor = $cor;
        $veiculo->tipo_combustivel = $combustivel;
        $veiculo->saldo = $saldo;
        $veiculo->observacoes = $observacao;
        $veiculo->origin_user = $user->name;
        $veiculo->last_user = $user->name;
        $veiculo->save();

        return view('veiculos.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $veiculo = veiculo::find($id);
        $veiculo->delete();

        return view('veiculos.index');
    }

    

}
