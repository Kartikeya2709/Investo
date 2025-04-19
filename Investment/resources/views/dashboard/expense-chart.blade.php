<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">Expense Breakdown</h3>
    <canvas id="expenseChart"></canvas>
</div>
<script>
    const expenseCtx = document.getElementById('expenseChart');
    new Chart(expenseCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($expenseLabels) !!},
            datasets: [{
                data: {!! json_encode($expenseData) !!},
                backgroundColor: ['#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa'],
            }]
        }
    });
</script>
