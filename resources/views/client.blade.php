<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Client</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
<form action="{{url('oauth/clients')}}" method="POST">
    <p>
        <t>Name</t>
        <input type="text" placeholder="Test User Name" name="name"/>
    </p>

    <p>
        <t>Redirect</t>
        <input type="text" placeholder="Test URL" name="redirect"/>
    </p>
    <p>
        <input type="submit" name="send" value="SUBMIT">
    </p>
    {{csrf_field()}}

</form>




 <table class="table">
    <thead style="background: #42a5f5">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Redirect</th>
        <th scope="col">Secret</th>

    </tr>
    </thead>
    @foreach($clients as $client)
        <tbody style="background: #e3f2fd">
        <tr>
            <th scope="row">{{$client->id}}</th>
            <td>{{$client->name}}</td>
            <td>{{$client->redirect}}</td>
            <td>{{$client->secret}}</td>

        </tr>
        </tbody>
    @endforeach
</table>

</body>
</html>
