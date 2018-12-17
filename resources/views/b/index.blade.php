@extends('layouts.main', ['title' => 'Главная'])

@section('content')

    @guest
    @else
        <a class="btn btn-secondary"
           href="{{route('createB1')}}?utm_source=main2&utm_medium=banner2&utm_company=myCompany2" role="link">Добавить
            заявку</a>
    @endguest
    <div class="starter-template">
        @if($items!=null)
            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Образование</th>
                    <th scope="col">Создана</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $did)
                    <tr>
                        <td>{{$did->id}}</td>
                        <td>{{$did->name}}</td>
                        <td>{{$did->femili}}</td>
                        <td>{{$did->getEducationName()}}</td>
                        <td>{{$did->created_at}}</td>
                        <td><a href="{{route('bDetail',['id'=>$did->id])}}">Смотреть подробно</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection