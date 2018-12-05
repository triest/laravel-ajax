@extends('layouts.main', ['title' => 'Главная'])

@section('content')

    @guest
    @else
        <a class="btn btn-secondary" href="{{route('createMain')}}" role="link">Добавить блок</a>
    @endguest
    <div class="starter-template">
        <p>
        <H2>{{$main->title}}</H2></p>
        <p class="lead">{{$main->description}}</p>

        <div class="container gallery-container">
            <div class="tz-gallery">
                <div class="row">
                    <div class="row">
                        @foreach($main->images()->get() as $image)
                            <div class="col-sm-6 col-md-4">
                                <a class="lightbox" href="<?php echo asset("/images/upload/$image->image_name")?>">
                                    <img height="250" src="<?php echo asset("/images/upload/$image->image_name")?>"
                                         alt="Park">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection