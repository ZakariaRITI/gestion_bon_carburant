<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display service</title>
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
        <h1 class="h1 fw-bold">Liste des services</h1> <br>

        @if(session('success'))
        <div class="alert alert-success w-50 mx-auto">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered border border-3 border-dark">
            <thead class="table-primary">
                <tr>
                    <th>CODE SERVICE</th>
                    <th>NOM SERVICE</th>
                    <th>MODIFIER</th>
                    <th>SUPPRIMER</th>
                </tr>
            </thead>
            @foreach($services as $service)
            <tbody class="tbody">
                <tr>
                    <td>{{$service->code_service}}</td>
                    <td>{{$service->nom_service}}</td>
                    <td><a href="/updateservice?id={{$service->id}}" class="btn btn-warning">update</a></td>
                    <td><a href="/deleteservice?id={{$service->id}}" class="btn btn-danger">delete</a></td>
                </tr>
            </tbody>
            @endforeach
        </table>

    </div>
    </div>
</div>
</body>
</html>