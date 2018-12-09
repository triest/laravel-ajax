@extends('layouts.main', ['title' => 'Назначить представителей'])

@section('content')
    <a class="btn btn-secondary" href="{{route('adminDid')}}" role="link">Заявки </a>
    <a class="btn btn-secondary" href="{{route('adminRand')}}" role="link">Рандомный контент</a> <br><br>
    <a class="btn btn-primary" href="{{route('makeOrganizer')}}" role="link">Назначить организаторов</a>
@endsection