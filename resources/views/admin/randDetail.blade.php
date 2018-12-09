@extends('layouts.main', ['title' => 'Панель администратора'])

@section('content')

    <h1>{{$item->title}}</h1>
    @if(Auth::user()->isSuperAdmin())
        <a class="btn btn-danger" onclick="return confirm('Вы уверены?')"
           href="{{route('deleteDid',['id'=>$item->id])}}" role="link">Удалить</a>
        <br>
    @endif
    <b>Создана:</b>
    <h7>{{$item->created_at}}</h7>
    <br>
    <b>Автор:</b>
    {{$item->femili}}
    {{$item->name}}
    <br>
    <b>Ip</b>
    {{$item->ip}}
    <br>

    <b>Описание:</b>
    <p>{{$item->description}}</p>

@endsection