@extends('layouts.main', ['title' => 'Создать новость'])


@section('content')
    <form action="{{route('storeMain')}}" method="post" enctype="multipart/form-data" novalidate>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Ведите заголовок"
                   required value={{ old('title') }} >
            @if($errors->has('title'))
                <font color="red"><p>  {{$errors->first('title')}}</p></font>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Описание:</label><br>
            <textarea class="col-md-12" name="description" id="description" rows="10" cols="50" style="height:100%;"
                      required placeholder="Введите текст"> {{old('description')}}</textarea>
            @if($errors->has('description'))
                <font color="red"><p>  {{$errors->first('description')}}</p></font>
            @endif
        </div>
        <br>
        <input type="file" id="file" name="file" accept="image/x-png,image/gif,image/jpeg"
               value="{{ old('file')}}" required>
        @if($errors->has('file'))
            <font color="red"><p>  {{$errors->first('file')}}</p></font>
        @endif
        <br>

        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list"/></td>
                <td>
                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                </td>
            </tr>
        </table>


        <br><br>
        <button type="submit" class="btn btn-default">Создать текст</button>
    </form>

    <script>
        $(document).ready(function () {
            var i = 1;
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $('#submit').click(function () {
                $.ajax({
                    url: "name.php",
                    method: "POST",
                    data: $('#add_name').serialize(),
                    success: function (data) {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });

        });
    </script>
@endsection

