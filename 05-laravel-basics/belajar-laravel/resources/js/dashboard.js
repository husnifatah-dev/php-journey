import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    
    const ctx = document.getElementById('shiftChart');

    if (ctx && window.statistikShift) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Shift Pagi','Shift Siang', 'Shift Malam'],
                datasets: [{
                    data: [window.statistikShift.pagi, window.statistikShift.siang, window.statistikShift.malam],
                    backgroundColor: ['#0d9488', '#b3644d', '#4f46e5'], 
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
});

