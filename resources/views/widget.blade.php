<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>widget</title>
</head>

<body style="width: 1000px">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Сотрудник</th>
            <th scope="col">Исходящих</th>
            <th scope="col">Среднее (сек)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($staffs as $staff)
            <tr>
                <td>{{ $staff['name'] }}</td>
                <td>{{ $staff['count']}}</td>
                <td>{{ $staff['avg'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
