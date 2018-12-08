@extends('layouts.main', ['title' => 'Панель администратора'])

@section('content')

    <h1>{{$did->name}}</h1>
    <b>Создана:</b>
    <h7>{{$did->created_at}}</h7>
    <br>
    <b>Автор:</b>
    {{$did->femili}}
    {{$did->name}}
    <br>
    @if(Auth::user()->isSuperAdmin())
        <a class="btn btn-danger" onclick="return confirm('Вы уверены?')"
           href="{{route('deleteDid',['id'=>$did->id])}}" role="link">Удалить</a>
        <br>
    @endif
    <b>Образование:</b>
    <p>{{$did->getEducationName()}}</p>

    <b>Описание:</b>
    <p>{{$did->description}}</p>




@endsection