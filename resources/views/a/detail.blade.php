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
            <br>

            <video width="320" height="240" controls>
                <source src="{{URL::asset("/images/upload/$itemContent->file_name")}}">
            </video>
            <br>
            <b>Скачать ролик:</b><a href="{{URL::asset("/images/upload/$itemContent->file_name")}}">скачать</a>
        @endif
    @endforeach
    <br>
    <a class="button blue" href="{{route('a')}}" role="link">К списку заявок</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
    <link href=”//vjs.zencdn.net/7.0/video-js.min.css” rel=”stylesheet”>
    <script src=”//vjs.zencdn.net/7.0/video.min.js”></script>
@endsection