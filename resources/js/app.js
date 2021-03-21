import Chart from 'chart.js/auto';
import 'chartjs-adapter-date-fns';
import { et } from 'date-fns/locale';

const ctx = document.getElementById('myChart');
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
            label: 'Negatiivsete testide arv',
            data: data.filter(item => item.ResultValue === 'N').map(item => item.DailyTests),
            backgroundColor: 'lightgreen'
        }],
    },
    options: {
        scales: {
            x: {
                adapters: {
                    date: {
                        locale: et
                    }
                },
                stacked: true,
                type: 'time',
                time: {
                    unit: 'month'
                }
            },
            y: {
                beginAtZero: true,
                stacked: true
            }
        }
    }
});