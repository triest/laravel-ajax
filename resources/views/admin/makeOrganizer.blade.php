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
        var k = 1;
        window.onload = function () {
            f();

        };

        function f() {
            // $("#body").remove();
            $("#example2").find("tr:not(:first)").remove();
            console.log("f")
            $.ajax({
                url: 'getUsers',
                data: null,
                type: 'get',
                success: function (data) {

                },
            }).done(function (data) {
                console.log(data);
                var i = 0;

                $.each(data, function (index, subcatObj) {
                    var x = document.getElementById('body').insertRow(0);
                    var y = x.insertCell(0);
                    var z = x.insertCell(1);
                    var subcatObj2 = subcatObj;
                    //   console.log(subcatObj);
                    y.innerHTML = '';
                    const did = y.appendChild(document.createElement('input'));
                    const rand = z.appendChild(document.createElement('input'));
                    did.type = 'button';
                    rand.type = 'button'
                    this.i = subcatObj.id;
                    if (subcatObj.didOrganizer == 0) {
                        did.value = 'Назначить куратором1';
                        did.addEventListener('click', () => makeDid(subcatObj));
                    }
                    else {
                        did.value = 'Снять куратора';
                        did.addEventListener('click', () => deleteDid(subcatObj));
                    }
                    if (subcatObj.randOrganizer == 0) {
                        rand.value = 'Назначить куратором ';
                        rand.addEventListener('click', () => makeRand(subcatObj));

                    }
                    else {
                        rand.value = 'Снять куратора';
                        rand.addEventListener('click', () => deleteRand(subcatObj));

                    }

                    var y = x.insertCell(0);
                    var z = x.insertCell(1);
                    y.innerHTML = subcatObj.name;
                    z.innerHTML = subcatObj.email;
                })

            });
        }

        function makeDid(item) {
            $.ajax({
                type: "POST",
                url: '/admin/makeDid',
                data: {id: item.id, user: item.name, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            f()
        }

        function deleteDid(item) {
            console.log('delete did')
            console.log(item)
            $.ajax({
                type: "POST",
                url: '/admin/deleteDid',
                data: {id: item.id, user: item.name, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            f()
        }

        function makeRand(item) {
            console.log(item);
            $.ajax({
                type: "POST",
                url: '/admin/makeRand',
                data: {id: item.id, user: item.name, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            f()
        }

        function deleteRand(item) {
            console.log('delete rand')
            console.log(item)
            $.ajax({
                type: "POST",
                url: '/admin/deleteRand',
                data: {id: item.id, user: item.name, _token: '{{csrf_token()}}'},
                success: function (data) {
                    console.log(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            f()
        }
    </script>
@endsection
