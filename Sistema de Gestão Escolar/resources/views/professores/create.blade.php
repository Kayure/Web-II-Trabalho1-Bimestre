<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Novo Professor"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Professores @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<form action="{{ route('professores.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" placeholder="Nome" value="{{old('nome')}}" />
                @if($errors->has('nome'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('nome') }}
                        </div>
                @endif
                <label for="nome">Nome </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input type="text" class="form-control {{ $errors->has('siape') ? 'is-invalid' : '' }}" name="siape" placeholder="Siape" value="{{old('siape')}}" />
                    @if($errors->has('siape'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('sigla') }}
                        </div>
                    @endif
                <label for="email">SIAPE</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="E-mail" value="{{old('email')}}" />
                    @if($errors->has('email'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                <label for="email">Email</label>
            </div>
        </div>
    </div>
    
    <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-dark text-white">Eixo</span>
                        <select name="eixo" class="form-select @if($errors->has('eixo')) is-invalid @endif">
                            @foreach ($eixos as $item)
                            <option value="{{$item->id}}" @if($item->id == old('eixo')) selected="true" @endif>
                                {{ $item->nome }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('eixo'))
                        <div class='invalid-feedback'>
                            {{ $errors->first('eixo') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col">
                <a href="{{route('professores.index')}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>
                <a href="javascript:document.querySelector('form').submit();" class="btn btn-success btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </a>
            </div>
        </div>
    </form>

@endsection