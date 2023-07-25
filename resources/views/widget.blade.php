<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>widget</title>
</head>

<body style="width: 500px">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Сотрудник</th>
            <th scope="col">Исходящих</th>
            <th scope="col">Среднее</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $staffs[0]['name'] }}</td>
            <td>{{ $staffs[0]['count']}}</td>
            <td>{{ $staffs[0]['avg'] }}</td>
        </tr>
        <tr>
            <td>{{ $staffs[0]['count']}}</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <td>{{ $staffs[0]['avg'] }}</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
