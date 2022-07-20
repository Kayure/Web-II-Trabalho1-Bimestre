<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

use function PHPUnit\Framework\isNull;

class ProfessorController extends Controller
{

    public function index()
    {

        $data = Professor::with(['eixo'])
        ->orderBy('nome')->get();

        return view('professores.index', compact(['data']));
    }

    public function create()
    {
        $eixos = Eixo::orderBy('nome')->get();
        return view('professores.create', compact(['eixos']));
    }

    public function validation(Request $request)
    {

        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professores',
            'siape' => 'required|max:10|min:8|unique:professores',
            'eixo' => 'required',
            'radio' => 'required',

        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "O campo [:attribute] pode ter apenas um único registro!"
        ];

        $request->validate($regras, $msgs);
    }

    public function store(Request $request)
    {

        Self::validation($request);

        $eixo = Eixo::find($request->eixo);

        if (isset($eixo)) {

            $obj = new Professor();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->siape = $request->siape;
            $obj->ativo = $request->radio;


            $obj->eixo()->associate($eixo);
            $obj->save();
            return redirect()->route('professores.index');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {

        $eixos = Eixo::orderBy('nome')->get();
        $data = Professor::with(['eixo' => function ($q) {
            $q->withTrashed();
        }])->find($id);


        if (isset($data)) {
            return view('professores.edit', compact(['data', 'eixos']));
        }
    }

    public function update(Request $request, $id)
    {


        $regras = [
            'nome' => 'required|max:100|min:5',
            'email' => 'required',
            'siape' => 'required',
            'radio' => 'required',
            'eixo' => 'required',

        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $eixo = Eixo::find($request->eixo);
        $obj_prof = Professor::find($id);

        if (isset($eixo) && isset($obj_prof)) {

            //PREENCHE OS CAMPOS COM OS DADOS DO PROFESSOR SELECIONADO
            $obj_prof->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_prof->email = mb_strtolower($request->email, 'UTF-8');
            $obj_prof->siape = $request->siape;
            $obj_prof->ativo = $request->radio;
            $obj_prof->eixo()->associate($eixo);
            $obj_prof->save();


            return redirect()->route('professores.index');
        }
    }

    public function destroy($id)
    {
        $obj = Professor::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Professor";
            $link = "professores.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('professores.index');
    }
}
