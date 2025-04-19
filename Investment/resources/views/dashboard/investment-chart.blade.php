<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">Investment Growth</h3>
    <canvas id="investmentChart"></canvas>
</div>


<script>
    const investmentCtx = document.getElementById('investmentChart');
    new Chart(investmentCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($investmentLabels) !!},
            datasets: [{
                label: 'Projected Value ($)',
                data: {!! json_encode($investmentData) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true,
            }]
        }
    });
</script>
