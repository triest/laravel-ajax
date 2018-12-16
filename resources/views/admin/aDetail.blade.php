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
    <b>Описание:</b>
    <p>{{$item->description}}</p>

    @foreach($content as $itemContent)
        @if($itemContent->content_type=='image')
            <div class="container gallery-container">
                <div class="tz-gallery">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <a class="lightbox" href="<?php echo asset("/images/upload/$itemContent->file_name")?>">
                                <img height="250" src="<?php echo asset("/images/upload/$itemContent->file_name")?>"
                                     alt="Park">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($itemContent->content_type=='video')
            <video controls>
                <source src="{{$url}}" type="video/mp4">
            </video>
        @endif
    @endforeach



    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>

@endsection