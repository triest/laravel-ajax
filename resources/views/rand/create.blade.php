@extends('layouts.main', ['title' => 'Создать заявку'])


@section('content')
    <form action="{{route('storeRand')}}" id="form" enctype="multipart/form-data" method="post" novalidate>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputFile">Описание заявки:</label>
            <br>
            <textarea name="description" id="description" required> {{old('description')}}</textarea>
        </div>
        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <td><input type="file" name="files[]" id="filesInfo" placeholder="Enter your Name"
                           class="form-control name_list"/></td>
                <td>
                    <button type="button" name="add" id="add" onclick="return f();" class="btn btn-success">Add More
                    </button>
                </td>
            </tr>
        </table>
        <br><br>
        <!--   <input type="button" onclick="return f();" value="Send"> -->
        <button type="submit" class="btn btn-default">Разместить анкету</button>

    </form>
    <script type="text/javascript">
        /*   function f() {
               var frm = $('#form');
               var formData = new FormData();
               var ins = document.getElementById('filesInfo').files.length;
               console.log(ins)
               for (var x = 0; x < ins; x++) {
                   formData.append("fileToUpload[]", document.getElementById('fileToUpload').files[x]);
               }

               var att = frm.attr("action");
               $.ajax({
                   url: att,
                   data: formData,
                   type: 'POST',
                   statusCode: {
                       200: function () {
                           console.log("200 - Success");
                           alert("Зайвка успешео создана!");
                       },
                       404: function (request, status, error) {
                           console.log("404 - Not Found");
                           console.log(error);
                           alert("Ошибка. Страница не неадена!");
                       },
                       503: function (request, status, error) {
                           console.log("503 - Server Problem");
                           console.log(error);
                           alert("Проблема сервера.");
                       }
                   },
               }).done(function (data) {
                   console.log(data);
               });

           }

           /*
                       var att = frm.attr("action");
                       $.ajax({
                           url: att,
                           data: formData,
                           type: 'POST',
                           statusCode: {
                               200: function () {
                                   console.log("200 - Success");
                                   alert("Зайвка успешео создана!");
                               },
                               404: function (request, status, error) {
                                   console.log("404 - Not Found");
                                   console.log(error);
                                   alert("Ошибка. Страница не неадена!");
                               },
                               503: function (request, status, error) {
                                   console.log("503 - Server Problem");
                                   console.log(error);
                                   alert("Проблема сервера.");
                               }
                           },
                       }).done(function (data) {
                           console.log(data);
                       });
                   }
           */
        /*
                    $.each($("input[type=file]"), function(i, obj) {
                        $.each(obj.files,function(j, file){
                            formData.append('files['+j+']', file);
                        })
                    });
        */


        $("form#form").submit(function (e) {
            e.preventDefault();
            var frm = $('#form');

            var att = frm.attr("action");
            var formData = new FormData(this);
            console.log("sub");
            $.ajax({
                url: att,
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert(data)
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $(document).ready(function () {
            var i = 1;
            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="file" name="files[]"  accept="image/x-png,image/gif,image/jpeg" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });

        function f() {
            console.log("adding file");

        }


    </script>



@endsection