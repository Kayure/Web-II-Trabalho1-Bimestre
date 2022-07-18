<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Curso;
use App\Models\Disciplina;



use function PHPUnit\Framework\isNull;

class ProfessorController extends Controller {
    
           
    
    public function index() {

        $dadosCursos  = Curso::with(['eixo']);

        $dadosDisciplinas = Disciplina::with(['curso'])
            ->orderBy('curso_id')->orderBy('id')->get();
        
        $dadosProfessores = Professor::with(['eixo']) -> get();
       
        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('professores.index', compact(['dadosCursos', 'dadosDisciplinas', 'dadosCursos']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);
    }

    public function create() {

        $dados = Professor::orderBy('nome')->get();
        return view('professores.create', compact(['eixos']));
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
            'email' => $request->email,
            'siape' => $request->siape,
            'eixo_id' => $request->eixo,
            
        ]);
        
        

        return redirect()->route('professores.index');
    }

    public function show($id) {
        
        $dados = Professor::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('professores.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Professor::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('professores.edit', compact('dados'));   
    }

    public function update(Request $request, $id) {
        
        $obj = Professor::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
            'siape' => $request->siape,
            'eixo_id' => $request->eixo,         
        ]);

        $obj->save();

        return redirect()->route('professores.index');
    }

    public function destroy($id) {

        $obj = Professor::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('professores.index');
    }
}
