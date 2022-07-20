<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Docencia;


class DocenciaController extends Controller
{

    public function index()
    {

        $cursos  = Curso::all();

        $disciplinas = Disciplina::all();

        $professores = Professor::orderBy('id')->get();

        return view('docencias.index', compact(['professores', 'disciplinas', 'cursos']));
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {

        $regras = [
            'PROFESSOR_ID_SELECTED' => 'required',
            'DISCIPLINA_ID_SELECTED' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $ids_prof = $request->PROFESSOR_ID_SELECTED;
        $ids_disciplina = $request->DISCIPLINA_ID_SELECTED;

        $doc = new Docencia();

        for ($i = 0; $i < count($ids_prof); $i++) {
            $doc->professor_id = $ids_prof[$i];

            for ($i = 0; $i < count($ids_disciplina); $i++) {
            
            $doc->disciplina_id = $ids_disciplina[$i];
           
            
        }
            $doc->save();
        }

        //O QUE TA ERRADO AQUI ?
        

        return redirect()->route('docencias.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
