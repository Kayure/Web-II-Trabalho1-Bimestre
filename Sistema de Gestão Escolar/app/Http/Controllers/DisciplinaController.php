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
        // return json_encode($data);
        return view('disciplinas.index', compact(['data']));
    }

    public function create()
    {

        $cursos = Curso::orderBy('nome')->get();
        return view('disciplinas.create', compact(['cursos']));
    }

    public function validation(Request $request)
    {

        $rules = [
            'nome' => 'required|max:100|min:5',
            'carga' => 'required',
            'curso' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);
    }

    public function store(Request $request)
    {

        self::validation($request);

        $total = Disciplina::where('nome', mb_strtoupper($request->nome, 'UTF-8'))
            ->where('curso_id', $request->curso)
            ->count();

        if ($total > 0) {
            $msg = "Disciplina";
            $link = "disciplinas.index";
            return view('erros.duplicado', compact(['msg', 'link']));
        }

        $curso = Curso::find($request->curso);
        if (isset($curso)) {
            $obj = new Disciplina();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->carga = $request->carga;
            $obj->curso()->associate($curso);
            $obj->save();
            return redirect()->route('disciplinas.index');
        }

        $msg = "Curso e/ou Área do Conhecimento";
        $link = "disciplinas.index";
        return view('erros.id', compact(['msg', 'link']));
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

        $total = Disciplina::where('nome', mb_strtoupper($request->nome, 'UTF-8'))
            ->where('curso_id', $request->curso)
            ->count();

        if ($total > 0) {
            $msg = "Disciplina";
            $link = "disciplinas.index";
            return view('erros.duplicado', compact(['msg', 'link']));
        }

        $curso = Curso::find($request->curso);
        $obj = Disciplina::find($id);

        if (isset($obj) && isset($curso)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->carga = $request->carga;
            $obj->curso()->associate($curso);
            $obj->save();
            return redirect()->route('disciplinas.index');
        }

        $msg = "Disciplina e/ou Curso e/ou Área do Conhecimento";
        $link = "disciplinas.index";
        return view('erros.id', compact(['msg', 'link']));
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
