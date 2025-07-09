<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prix carburant</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
        <div id="menu">
            @include('menu')
        </div><br> <br> <br> <br> <br>
    <h1 class="h1 text-center mt-4 fw-bold">Prix carburant</h1>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <form action="/pcs" method="get" class="w-100 border rounded p-4 shadow" style="max-width: 400px;">
        <label for="e" class="form-label">Essence:</label><br><input type="number" id="e" name="essence" value="{{ $carb[0] }}" class="form-control" min="0" step="0.01"> <br>
        <label for="d" class="form-label">Diesel:</label><br><input type="number" id="d" name="diesel" value="{{ $carb[1] }}" class="form-control" min="0" step="0.01"> <br> <br>
        <input type="submit" value="changer" class="btn btn-primary w-100">
    </form>
    </div>
</body>
</html>