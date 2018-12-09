@extends('layouts.main', ['title' => 'Панель администратора'])

@section('content')
    <a class="btn btn-secondary" href="{{route('adminDid')}}" role="link">Назначить кураторов на заявку </a>
    <a class="btn btn-secondary" href="{{route('adminRand')}}" role="link">Назначить кураторов на рандомный контент</a>


    <table id="example" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Имя</th>
            <th scope="col">Создана</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rands as $did)
            <tr>
                <td>{{$did->id}}</td>
                <td>{{$did->title}}</td>
                <td>{{$did->created_at}}</td>
                <td><a href="{{route('showRand',['id'=>$did->id])}}">Смотреть подробно</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

