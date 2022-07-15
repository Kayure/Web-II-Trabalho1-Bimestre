<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cursos/title>
</head>
<body>
    <a href="{{route('disciplinas.index')}}">Voltar</a>
    <br>
    <label>ID: </label>{{$dados['id']}}
    <br>
    <label>Nome: </label>{{$dados['nome']}}
    <br>
    <label>Sigla: </label>{{$dados['sigla']}}
    <br>
    <label>Tempo: </label>{{$dados['tempo']}}
    <br>
    <label>Eixo: </label>{{$dados['eixo']}}
</body>
</html>