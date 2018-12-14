@extends('layouts.main', ['title' => 'Панель администратора'])

@section('content')

    <h1>{{$item->title}}</h1>
    @if(Auth::user()->isSuperAdmin())
        <a class="btn btn-danger" onclick="return confirm('Вы уверены?')"
           href="{{route('deleteRand',['id'=>$item->id])}}" role="link">Удалить</a>
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

    <div class="container gallery-container">
        <div class="tz-gallery">
            <div class="row">
                @foreach($images as $image)
                    <div class="col-sm-6 col-md-4">
                        {{$image->title}} <br>
                        <a class="lightbox" href="<?php echo asset("/images/upload/$image->image_name")?>">
                            <img height="250" src="<?php echo asset("/images/upload/$image->image_name")?>" alt="Park">
                        </a><br>
                        <b> <a href="{{route('imagedetail',['id'=>$image->id])}}">подробно...</a></b>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>

@endsection