@extends('layouts.main', ['title' => $item->name])

@section('content')

    <h1>{{$item->name}}</h1>
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

    <b>Образование:</b>
    <p>{{$item->getEducationName()}}</p>

    <b>Описание:</b>
    <p>{{$item->description}}</p>

@endsection