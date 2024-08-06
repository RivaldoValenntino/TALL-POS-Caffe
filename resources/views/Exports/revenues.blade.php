<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenues Report</title>
</head>

<body>
    <table style="border: 1px solid black; width: 100%;">
        <thead>
            <tr>
                <th>Revenue</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revenues as $revenue)
                <tr>
                    <td>@currency($revenue->revenue) </td>
                    <td>{{ $revenue->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
