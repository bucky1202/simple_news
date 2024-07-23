@extends('user.layouts.layout')
@include('admin.header')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <div class="container">
        <div>
            <h2>Top 5 Authors by News Created</h2>
            <ul>
                @foreach ($topUsers as $user)
                    <li>User name: {{ $user->author}} | News Count: {{ $user->news_count }}</li>
                @endforeach
            </ul>
            <div class="card">
                <div class="card-body">
                    <h2>News Created by Month</h2>
                    <canvas id="newsByMonthChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<script>

    Prepare data for the chart
    var months = @json($months);
    var newsCounts = @json($newsCounts);

    var ctx = document.getElementById('newsByMonthChart').getContext('2d');
    var newsByMonthChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'News Created',
                data: newsCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });


</script>
@endsection
