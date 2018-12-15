
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
            <textarea class="col-md-12" name="description" id="description" style="height:100%;"
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

        <div id="images">

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

    <!--delete imag script -->
    <script type='text/javascript'>
        var name;
        function UpdateStatus(name) {
            this.name = name.valueOf(name);
            console.log(this.name);
            console.log("button");
        }
    </script>

    <script>

    </script>
    <center>
        <br/><br/>
        <div style="width:350px;height: 350px; border: 1px solid whitesmoke ;text-align: center;position: relative"
             id="image">
            <img width="100%" height="100%" id="preview_image" src="{{asset('images/noimage.jpg')}}"/>
            <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw"
               style="position: absolute;left: 40%;top: 40%;display: none"></i>
        </div>
        <p>
            <a href="javascript:changeProfile()" style="text-decoration: none;">
                <i class="glyphicon glyphicon-edit"></i> Change
            </a>&nbsp;&nbsp;
            <a href="javascript:removeFile()" style="color: red;text-decoration: none;">
                <i class="glyphicon glyphicon-trash"></i>
                Remove
            </a>
        </p>
        <input type="file" id="file" style="display: none"/>
        <input type="hidden" id="file_name"/>
    </center>
    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
    <script>
        function getImages() {
            $("#images").html("");
            document.getElementById("images").innerHTML = "";
            $.ajax({
                url: 'getImages',
                data: null,
                type: 'get',
                success: function (data) {
                    console.log(data);
                },
            }).done(function (data) {
                console.log(data);
                var i = 0;
                $.each(data, function (index, subcatObj) {
                    console.log("get mages")
                    $('#images').append('<div class="col-md-3 col-sm-3 hero-feature"><div class="thumbnail"><img height=300 src="{{ url('images/upload/') }} ' + '/' + subcatObj.image_name + '" alt=""></div>')

                })
            });
        }

        window.onload = function () {
            getImages();
        };
        function changeProfile() {
            $('#file').click();
        }
        $('#file').change(function () {
            if ($(this).val() != '') {
                upload(this);
            }
        });
        function upload(img) {
            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{url('main/imageUpload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.fail) {
                        $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                        alert(data.errors['file']);
                    }
                    else {
                        console.log("success");
                        getImages();
                    }
                    $('#loading').css('display', 'none');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                }
            });

        }
        function removeFile() {
            if ($('#file_name').val() != '')
                if (confirm('Are you sure want to remove profile picture?')) {
                    $('#loading').css('display', 'block');
                    var form_data = new FormData();
                    form_data.append('_method', 'DELETE');
                    form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url: "ajax-remove-image/" + $('#file_name').val(),
                        data: form_data,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                            $('#file_name').val('');
                            $('#loading').css('display', 'none');
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }
            getImages();
        }
    </script>

@endsection
