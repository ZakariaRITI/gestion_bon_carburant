<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display user</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>
    <div id="d1">
    <div id="menu1">
        @include('menu2')
    </div>

    <div style="margin-left:500px;">
    <div class="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br>
        <hr>
        <h1 class="h1 fw-bold">Liste des utilisateurs</h1> <br>

        @if(session('success'))
        <div class="alert alert-success w-50 mx-auto">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered border border-3 border-dark">
            <thead class="table-primary">
                <tr>
                    <th>NAME USER</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>TYPE</th>
                    <th>MODIFIER</th>
                    <th>SUPPRIMER</th>
                </tr>
            </thead>
            @foreach($users as $user)
            <tbody class="tbody">
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>****************</td>
                    <td>{{$user->type}}</td>
                    <td><a href="/updateuser?id={{$user->id}}" class="btn btn-warning">update</a></td>
                    <td><a href="/deleteuser?id={{$user->id}}" class="btn btn-danger">delete</a></td>
                </tr>
            </tbody>
            @endforeach
        </table>

    </div>
    </div>
</div>
</body>
</html>