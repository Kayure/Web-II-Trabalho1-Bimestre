<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class DisciplinaController extends Controller {
    
           
    
    public function index() {
        
        $dados = Disciplina::with(['curso']) -> get();
        $clinica = "VetClin DWII";

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('disciplinas.index', compact(['dados', 'clinica']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);
    }

    public function create() {

        return view('disciplinas.create');
    }

    public function store(Request $request) {

        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:150|min:15|unique:clientes',
           
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um endereço cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);

        Professor::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => $request->siape,
            'curso_id' => $request->curso,
            
            
            
        ]);
        
        

        return redirect()->route('disciplinas.index');
    }

    public function show($id) {
        
        $dados = Professor::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('disciplinas.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Professor::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('disciplinas.edit', compact('dados'));   
    }

    public function update(Request $request, $id) {
        
        $obj = Professor::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => $request->siape,
            'curso_id' => $request->curso,
                    
        ]);

        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id) {

        $obj = Professor::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('disciplinas.index');
    }
}
