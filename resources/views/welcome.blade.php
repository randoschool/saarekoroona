<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saare stat</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Saaremaa testid</h1>
    <div>Tehtud teste: {{ $data->where('ResultValue', 'N')->last()['DailyTests'] }}</div>
    <div>Positiivseid teste: {{ $data->last()['DailyCases'] }}</div>
    <div>Viimase tulemuse kuupäaev: {{ $data->last()['StatisticsDate'] }}</div>
    <canvas id="myChart" height="30vh" width="80vw"></canvas>
    <script>
        const ctx = document.getElementById('myChart');
        const data = @json($data->toArray());
        const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data.filter(item => item.ResultValue === 'P').map(item => item.StatisticsDate),
        datasets: [{
            label: 'Positiivsete testide arv',
            data: data.filter(item => item.ResultValue === 'P').map(item => item.DailyCases),
            backgroundColor: 'red'
        },
        {
            label: 'Tehtud testide arv',
            data: data.filter(item => item.ResultValue === 'N').map(item => item.DailyTests),
            backgroundColor: 'lightgreen'
        }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    </script>
</body>
</html>