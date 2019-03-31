@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
    <form action="{{route('perfil.salvar')}}" method="post">
    {{csrf_field()}}
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="name" id="nome" class="form-control" 
            value="{{ auth()->user()->name }}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" 
            value="{{ auth()->user()->email }}">
        </div>
        <button class="btn btn-success">Salvar</button>
    </form>  
@stop

