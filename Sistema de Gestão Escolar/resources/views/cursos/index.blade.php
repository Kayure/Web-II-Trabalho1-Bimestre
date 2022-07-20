<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Cursos", 'rota' => "cursos.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Cursos @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-cursoDatalist 
                :header="['NOME', 'SIGLA', 'TEMPO','EIXO','AÇÕES']" 
                :data="$data"
                :hide="[true, false, true, false, true]" 
            />

        </div>
    </div>
@endsection