<!doctype html>
<head>

</head>
<body>
<?php

?>
Уважаемый(я) {{$name}}! <br>
На мероприятие {{$event}}, куратором которого вы являетесь, зарегистрировался новый пользователь. <br>
<br>
Фамилия: {{$did->femili}} <br>
Имя: {{$did->name}}<br>
Телефон: {{$did->phone}}<br>
email: {{$did->email}}<br>
Образование:{{$did->getEducationName()}}<br>
ip:{{$did->ip}}<br>
Создана:{{$did->created_at}}<br>
Описание: <br>
{{$did->description}}

<br>Адрес заявки:
<a href="http://ajax/a/{{$did->id}}">http://ajax/a/{{$did->id}}</a>

</body>
</html>