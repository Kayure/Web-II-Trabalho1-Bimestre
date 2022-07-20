<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

class EixoController extends Controller {
    
           
    
    public function index() {
        
        $dados = Eixo::all();
        

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('eixos.index', compact(['dados']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);
    }

    public function create() {

        return view('eixos.create');
    }

    public function store(Request $request) {

        self::validation($request);       

        Eixo::create(['nome' =>  mb_strtoupper($request->nome, 'UTF-8')]);
        return redirect()->route('eixos.index');
                    
        
    }

    public function validation(Request $request) {

        $regras = [
            'nome' => 'required|max:50|min:5',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);
    }

    public function show($id) {
        
        $dados = Eixo::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('eixos.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Eixo::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('eixos.edit', compact('dados'));   
    }

    public function update(Request $request, $id) {

        self::validation($request);
        
        $obj = Eixo::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        //PREENCHE OS CAMPOS COM OS DADOS DO CAMPO SELECIONADO
        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
                
        ]);

        $obj->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id) {

        $obj = Eixo::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('eixos.index');
    }
}
