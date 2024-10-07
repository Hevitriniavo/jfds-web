document.addEventListener("DOMContentLoaded", async function () {
    await loadMemberCountsAndRenderChart();
    await renderChart();
    await loadSacramentByYearRenderChart();
    await loadActivityByMonthRenderChart();
    await loadBudgetByMonthRenderChart();
    await loadBudgetByYearRenderChart();
});


function loadMemberCountsAndRenderChart() {
    fetch('/api/member-counts')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const years = data.map(item => item.year);
            const counts = data.map(item => item.member_count);

            const ctx = document.getElementById('memberChart').getContext('2d');

            const backgroundColors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Nombre de Membres',
                        data: counts,
                        backgroundColor: backgroundColors.slice(0, counts.length),
                        borderColor: backgroundColors.map(color => color.replace('0.2', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching member counts:', error));
}


async function fetchSexStatistics() {
    try {
        const response = await fetch('/api/sex-year');
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        return await response.json();
    } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
    }
}

async function renderChart() {
    const data = await fetchSexStatistics();
    console.log(data)
    const labels = Object.keys(data);
    const maleCounts = labels.map(year => (data[year]['male'] || 0));
    const femaleCounts = labels.map(year => (data[year]['female'] || 0));
    const otherCounts = labels.map(year => (data[year]['other'] || 0));

    const ctx = document.getElementById('sexStatisticsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Male',
                    data: otherCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                }, {
                    label: 'Male',
                    data: maleCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },

                {
                    label: 'Female',
                    data: femaleCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}



async function loadSacramentByYearRenderChart() {
    const data = await fetch('/api/sacrament-year').then(response => response.json());
    const years = data.map(item => item.year);
    const counts = data.map(item => item.sacrament_count);

    const ctx = document.getElementById('sacramentChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: 'Nombre de Sacrements',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

async function loadActivityByMonthRenderChart() {
    const data = await fetch('/api/activity-month').then(response => response.json());
    const months = data.map(item => item.month);
    const activityCounts = data.map(item => item.activity_count);
    const presentCounts = data.map(item => item.present_count);
    const absentCounts = data.map(item => item.absent_count);

    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Total Activités',
                    data: activityCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
                {
                    label: 'Présents',
                    data: presentCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                    label: 'Absents',
                    data: absentCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

async function loadBudgetByMonthRenderChart() {
    const data = await fetch('/api/budget-month').then(response => response.json());
    const months = data.map(item => item.month);
    const totalBudgets = data.map(item => item.total_budget);
    const totalEntries = data.map(item => item.total_entry);
    const totalExits = data.map(item => item.total_exit);

    const ctx = document.getElementById('budgetMonthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Budget Total',
                    data: totalBudgets,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                },
                {
                    label: 'Entrées',
                    data: totalEntries,
                    backgroundColor: 'rgba(255, 206, 86, 0.6)',
                },
                {
                    label: 'Sorties',
                    data: totalExits,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

async function loadBudgetByYearRenderChart() {
    const data = await fetch('/api/budget-year').then(response => response.json());
    const years = data.map(item => item.year);
    const totalBudgets = data.map(item => item.total_budget);

    const ctx = document.getElementById('budgetYearChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Budget Total par Année',
                data: totalBudgets,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}