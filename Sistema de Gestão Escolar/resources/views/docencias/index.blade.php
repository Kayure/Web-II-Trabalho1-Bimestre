@extends('templates.main', ['titulo' => "Docencia", 'rota' => "docencias.index"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Docencia @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row mb-3">
    <div class="col">
        <table class="table align-middle caption-top table-striped" id="tabela">
            <caption>Tabela de <b>Disciplinas / Professores</b></caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">Disciplina</th>
                    <th scope="col" class="text-center">Professor</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('docencias.store') }}" method="POST">
                    @csrf
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <td scope="col" class="text-center col-md-6 ">
                                <div class="input-group mb-3">
                                    <input type="hidden" readonly class="form-control-plaintext" name="DISCIPLINA[]" value="{{$disciplina->id}}">
                                    {{$disciplina->nome}}
                                </div>
                            </td>
                            <td scope="col" class="text-center">
                                <select name="PROFESSOR_ID_SELECTED[]" class="form-select @if($errors->has('PROFESSOR_ID_SELECTED')) is-invalid @endif" class="form-control ">
                                    @foreach ($profs as $item)
                                        @if($item->ativo == 1)
                                        <option value="{{$item->id}}" @if($item->id == old('profs')) selected="true" @endif>
                                            {{ $item->nome }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($errors->has('PROFESSOR_ID_SELECTED'))
                                    <div class='invalid-feedback'>
                                        {{ $errors->first('PROFESSOR_ID_SELECTED') }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <a href="{{route('professores.index')}}" class="btn btn-danger btn-block align-content-center w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp;<b>Cancelar</b>
                </a>
            </div>
            <div class="col-lg-8 col-md-12">
                <button class="btn btn-success btn-block text-white mb-2 w-100" type="submit" id="bt_salvar">
                    <b>Confirmar</b>&nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </button>
            </div>
        </div>
        </form>

    </div>
</div>



@endsection

@section('script')

<script type="text/javascript"></script>
@endsection