@extends('layouts.main', ['title' => 'Создать новость'])


@section('content')
    <form action="{{route('updateMain')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input type="text" class="form-control" id="title" name="title" required="required"
                   placeholder="Ведите заголовок"
                   required value="{{ old('title' . $main->title, $main->title) }}">
            @if($errors->has('title'))
                <font color="red"><p>  {{$errors->first('title')}}</p></font>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Описание:</label><br>
            <textarea class="col-md-12" name="description" id="description" rows="10" cols="50" style="height:100%;"
                      required="required" placeholder="Введите текст">{{$main->description}}</textarea>
            @if($errors->has('description'))
                <font color="red"><p>  {{$errors->first('description')}}</p></font>
            @endif
        </div>
        <br>
        <br>

        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <td><input type="file" name="image[]" placeholder="Enter your Name" class="form-control name_list"
                    />
                </td>
                <td>
                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                </td>
            </tr>
        </table>
        <div class="container gallery-container">
            <div class="tz-gallery">
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

        <br><br>
        <button type="submit" class="btn btn-default">Сохранить</button>
    </form>

    <script>
        $(document).ready(function () {
            var i = 1;
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="file" name="image[]"  accept="image/x-png,image/gif,image/jpeg" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection

