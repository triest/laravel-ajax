@extends('layouts.main', ['title' => 'Назначить представителей'])

@section('content')
    <a class="btn btn-secondary" href="{{route('adminA')}}" role="link">A</a>
    <a class="btn btn-secondary" href="{{route('adminB')}}" role="link">B </a> <br>
    <a class="btn btn-primary" href="{{route('makeOrganizer')}}" role="link">Назначить организаторов</a>
@endsection