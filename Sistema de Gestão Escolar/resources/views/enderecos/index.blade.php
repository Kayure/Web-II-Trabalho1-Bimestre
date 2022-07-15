<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Endereços", 'rota' => "enderecos.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Endereços @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-datalist 
                :title="'Endereços'"
                :crud="'enderecos'"
                :header="['ID', 'RUA', 'NÚMERO', 'AÇÕES']" 
                :fields="['id', 'rua', 'numero']"
                :data="$dados"
                :hide="[true, false, true, false]" 
                :info="['id', 'rua', 'numero', 'cep']"
                :remove="'rua'"
            />
        </div>
    </div>
@endsection