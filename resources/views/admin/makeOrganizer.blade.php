@extends('layouts.main', ['title' => 'Назначить организаторов'])

@section('content')


    <table id="example2" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Куратор заявок</th>
            <th scope="col">Куратор рандомного контента</th>
        </tr>
        </thead>
        <tbody id="body">


        </tbody>
    </table>


    <script>
        window.onload = function () {
            f();

        };

        function f() {
            console.log("f")
            $.ajax({
                url: 'getUsers',
                data: null,
                type: 'get',
                success: function (data) {

                },
            }).done(function (data) {
                console.log(data);
                var i = 1;
                $.each(data, function (index, subcatObj) {
                    //console.log(subcatObj.id);
                    console.log(subcatObj.name);
                    console.log(subcatObj.email);
                    var x = document.getElementById('body').insertRow(0);
                    var y = x.insertCell(0);
                    var z = x.insertCell(1);
                    y.innerHTML = subcatObj.name;
                    z.innerHTML = subcatObj.email;
                })

            });
        }


    </script>
@endsection
