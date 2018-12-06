@extends('layouts.main', ['title' => 'Создать заявку'])


@section('content')
    <form action="{{route('storeDid')}}" id="form"  enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" required="required" placeholder="Введите имя"
                   required value={{ old('name') }} >
            @if($errors->has('title'))
                <font color="red"><p>  {{$errors->first('name')}}</p></font>
            @endif
        </div>
        <div class="form-group">
            <label for="femili">Фамилия:</label>
            <input type="text" class="form-control" id="femili" name="femili" required="required"
                   placeholder="Введите фамилию"
                   required value={{ old('femili') }} >
            @if($errors->has('femili'))
                <font color="red"><p>  {{$errors->first('femili')}}</p></font>
            @endif
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="phone" class="form-control" id="phone" name="phone" required="required"
                   placeholder="Введите телефон"
                   required pattern="[0-9]{10}" value={{ old('phone') }} >
            @if($errors->has('title'))
                <font color="red"><p>  {{$errors->first('femili')}}</p></font>
            @endif
        </div>
        Образование:
        <select style="width: 200px" class="education" name="education" class="form-control input-sm" id="education">
            @foreach($educations as $education)
                <option value="{{$education->id}}">{{$education->name}}</option>
            @endforeach
        </select>

        <br><br>
       <!-- <button type="submit" class="btn btn-default">Создать текст</button> -->
        <input type="button" onclick="return f();" value="Send">
    </form>
    <script type="text/javascript">
        function f() {
           
            var frm = $('#form');
            frm.submit(function (e) {
                console.log("submit");
            })
        }


    </script>
@endsection