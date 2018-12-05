@extends('layouts.main', ['title' => 'Главная'])

@section('content')

    @guest
    @else
        <a class="btn btn-secondary" href="{{route('createMain')}}" role="link">Добавить блок</a>

    @endguest

@endsection