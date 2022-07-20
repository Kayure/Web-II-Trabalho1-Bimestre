<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;
use App\Models\Eixo;

use Illuminate\Support\Facades\Log;

class DisciplinaController extends Controller
{

    public function index()
    {


        $data = Disciplina::with(['curso'])
            ->orderBy('nome')->get();
        
        return view('disciplinas.index', compact(['data']));
    }

    public function create()
    {

        $cursos = Curso::orderBy('nome')->get();
        return view('disciplinas.create', compact(['cursos']));
    }

    public function validation(Request $request)
    {

        $regras = [
            'nome' => 'required|max:100|min:10',
            'carga' => 'required',
            'curso' => 'required|max:12|min:1',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);
    }

    public function store(Request $request)
    {

        self::validation($request);

        $total = Disciplina::where('nome', mb_strtoupper($request->nome, 'UTF-8'))
            ->where('curso_id', $request->curso)
            ->count();

        

        $curso = Curso::find($request->curso);
        if (isset($curso)) {
            $obj = new Disciplina();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->carga = $request->carga;
            $obj->curso()->associate($curso);
            $obj->save();
            return redirect()->route('disciplinas.index');
        }
        
        return redirect()->route('disciplinas.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $cursos = Curso::orderBy('nome')->get();
        $data = Disciplina::find($id);

        if (isset($data)) {
            return view('disciplinas.edit', compact(['data', 'cursos']));
        } else {
            $msg = "Disciplina";
            $link = "disciplinas.index";
            return view('erros.id', compact(['msg', 'link']));
        }
    }

    public function update(Request $request, $id)
    {

        self::validation($request);

        

        $curso = Curso::find($request->curso);
        $obj = Disciplina::find($id);

        //PREENCHE OS CAMPOS COM OS DADOS DA DISCIPLINA SELECIONADA
        if (isset($obj) && isset($curso)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->carga = $request->carga;
            $obj->curso()->associate($curso);
            $obj->save();
            return redirect()->route('disciplinas.index');
        }

        
        return redirect()->route('disciplinas.index');
    }

    public function destroy($id)
    {

        $obj = Disciplina::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Disciplina";
            $link = "disciplinas.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('disciplinas.index');
    }
}
