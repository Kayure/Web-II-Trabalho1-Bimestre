<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Professores @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-professorDatalist 
                :header="['STATUS','ID', 'NOME', 'EMAIL', 'EIXO','SIAPE','AÇÕES']" 
                :data="$data"
                :hide="[true, true, false, true, false, true, true]" 
            />

        </div>
    </div>
@endsection