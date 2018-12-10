@extends('layouts.main', ['title' => 'Главная'])

@section('content')

    @guest
    @else
        <a class="btn btn-secondary" href="{{route('createA')}}" role="link">Добавить заявку</a>
    @endguest
    @if($rands!=null)
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
                    <td><a href="{{route('randDetail',['id'=>$did->id])}}">Смотреть подробно</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection