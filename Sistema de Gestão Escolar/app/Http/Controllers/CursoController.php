<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Curso::with(['eixo' => function ($q) {
            $q->withTrashed();
        }])->orderBy('nome')->get();

        return view('cursos.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eixos = Eixo::orderBy('nome')->get();
        return view('cursos.create', compact(['eixos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Curso::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo,

        ]);

        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eixos = Eixo::orderBy('nome')->get();
        $data = Curso::find($id);

        if (isset($data)) {
            return view('cursos.edit', compact(['data', 'eixos']));
        } else {
            $msg = "Curso";
            $link = "curso.index";
            return view('erros.id', compact(['msg', 'link']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'nome' => 'required|max:100|min:5',
            'sigla' => 'required',
            'tempo' => 'required',
            'eixo' => 'required',

        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

        $eixo = Eixo::find($request->eixo);
        $obj = Curso::find($id);
        if (isset($eixo) && isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj->tempo = $request->tempo;
            $obj->eixo()->associate($eixo);
            $obj->save();
            return redirect()->route('cursos.index');
        }

        $msg = "Curso ou Eixo/Área";
        $link = "cursos.index";
        return view('erros.id', compact(['msg', 'link']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Curso::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Curso";
            $link = "cursos.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('cursos.index');
    }
}
