<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saare stat</title>
</head>
<body>
    <h1>Saaremaa testid</h1>
    <div>Tehtud teste: {{ $data->where('ResultValue', 'N')->last()['DailyTests'] + $data->where('ResultValue', 'P')->last()['DailyTests'] }}</div>
    <div>Positiivseid teste: {{ $data->last()['DailyCases'] }}</div>
    <div>Viimase tulemuse kuupäaev: {{ $data->last()['StatisticsDate'] }}</div>
    <canvas id="myChart" height="30vh" width="80vw"></canvas>
    <script>
        const data = @json($data->toArray());
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>