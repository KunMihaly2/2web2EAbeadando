@extends('layouts.balaton')

@section('title', 'Diagram')

@section('content')
    <h1>Hajók típus szerint</h1>

    @if ($cimkek === [])
        <p>Még nincs adat a diagramhoz.</p>
    @else
        <div style="position: relative; height: 420px">
            <canvas id="hajok-diagram" role="img"
                    aria-label="A hajók darabszáma típusonként"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.9/dist/chart.umd.min.js"></script>
        <script>
            new Chart(document.getElementById('hajok-diagram'), {
                type: 'bar',
                data: {
                    labels: {{ \Illuminate\Support\Js::from($cimkek) }},
                    datasets: [{
                        label: 'Hajók száma',
                        data: {{ \Illuminate\Support\Js::from($darabszamok) }},
                        backgroundColor: '#23759b',
                    }],
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            title: { display: true, text: 'Darabszám' },
                        },
                    },
                },
            });
        </script>
    @endif
@endsection