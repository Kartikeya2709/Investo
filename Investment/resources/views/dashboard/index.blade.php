@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Universal Control Bar -->
    <div class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4 justify-between items-center">
        <div class="flex items-center gap-4">
            <label for="chartType" class="font-medium">Chart Type:</label>
            <select id="chartType" class="border rounded p-1">
                <option value="line">Line</option>
                <option value="bar">Bar</option>
                <option value="doughnut">Doughnut</option>
                <option value="pie">Pie</option>
            </select>
        </div>
        <div class="flex items-center gap-4">
            <label for="startDate" class="font-medium">From:</label>
            <input type="date" id="startDate" class="border rounded p-1">
            <label for="endDate" class="font-medium">To:</label>
            <input type="date" id="endDate" class="border rounded p-1">
        </div>
        <button id="exportBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Export</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ([
            ['id' => 'investmentChart', 'title' => 'Investment Growth', 'labels' => $investmentLabels, 'data' => $investmentData],
            ['id' => 'expenseChart', 'title' => 'Expense Breakdown', 'labels' => $expenseLabels, 'data' => $expenseData],
            ['id' => 'monthlyChart', 'title' => 'Monthly Expenses', 'labels' => $monthlyLabels, 'data' => $monthlyTotals],
        ] as $chart)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-bold mb-2">{{ $chart['title'] }}</h3>
                <canvas id="{{ $chart['id'] }}"></canvas>
                <div class="mt-4">
                    <h4 class="text-sm font-semibold">Raw Data:</h4>
                    <ul class="text-sm text-gray-600 list-disc pl-4">
                        @foreach ($chart['labels'] as $index => $label)
                            <li>{{ $label }}: {{ $chart['data'][$index] ?? 'N/A' }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

        <!-- AI Insight Card -->
        <div class="col-span-1 md:col-span-2 bg-white p-4 rounded shadow">
            <h3 class="text-lg font-bold mb-2">AI Financial Insight</h3>
            <p class="text-gray-600 italic">{{ $aiInsight }}</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    const chartConfigs = [
        {
            id: 'investmentChart',
            labels: @json($investmentLabels),
            data: @json($investmentData),
            label: 'Investments ($)'
        },
        {
            id: 'expenseChart',
            labels: @json($expenseLabels),
            data: @json($expenseData),
            label: 'Expenses ($)'
        },
        {
            id: 'monthlyChart',
            labels: @json($monthlyLabels),
            data: @json($monthlyTotals),
            label: 'Monthly Expenses ($)'
        },
    ];

    const charts = {};

    function renderCharts(type = 'line') {
        chartConfigs.forEach(cfg => {
            const ctx = document.getElementById(cfg.id).getContext('2d');
            if (charts[cfg.id]) charts[cfg.id].destroy();
            charts[cfg.id] = new Chart(ctx, {
                type: type,
                data: {
                    labels: cfg.labels,
                    datasets: [{
                        label: cfg.label,
                        data: cfg.data,
                        backgroundColor: ['#60a5fa', '#34d399', '#fbbf24', '#f87171', '#a78bfa'],
                        borderColor: '#4b5563',
                        borderWidth: 1,
                        fill: type === 'line',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderCharts();

        // Chart type switch
        document.getElementById('chartType').addEventListener('change', e => {
            renderCharts(e.target.value);
        });

        // PDF export
        document.getElementById('exportBtn').addEventListener('click', () => {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            let y = 10;

            chartConfigs.forEach(cfg => {
                const canvas = document.getElementById(cfg.id);
                const imgData = canvas.toDataURL("image/png", 1.0);
                doc.text(cfg.label, 10, y);
                doc.addImage(imgData, 'PNG', 10, y + 5, 180, 80);
                y += 90;
            });

            doc.save("dashboard_charts.pdf");
        });
    });
</script>
@endsection
