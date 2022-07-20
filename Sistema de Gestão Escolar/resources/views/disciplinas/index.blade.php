<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Cursos @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-disciplinaDatalist 
                :header="['NOME', 'CURSO', 'CARGA','AÇÕES']" 
                :data="$data"
                :hide="[true, false, true, false,false]" 
            />

        </div>
    </div>
@endsection