document.addEventListener('DOMContentLoaded', async () => {

    /*await axios.get('/api-count')
        .then(pieChart)*/

    await axios.get('/api-reservations')
        .then(lineChart)

})



async function pieChart(response) {

    createChart(
        document.getElementById('evenements').getContext('2d'),
        {
            labels: [
                'Theatres',
                'Concerts',
                'OneManShow',
                'Expositions'
            ],
            datasets: [{
                label: 'Evenements',
                data: [
                    response.data.evenements.theatres,
                    response.data.evenements.concerts,
                    response.data.evenements.humours,
                    response.data.evenements.expositions
                ],
                backgroundColor: [
                    '#397367',
                    '#E84855',
                    '#8B5FBF',
                    '#F9DC5C'
                ],
                hoverOffset: 4
            }]
        },
        'doughnut',
        {
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Nombre d\'Evenements par Type d\'Evenements',
                }
            }
        }
    )

    createChart(
        document.getElementById('users').getContext('2d'),
        {
            labels: [
                'Users avec Reservations',
                'Users sans Reservations'
            ],
            datasets: [{
                label: 'Evenements',
                data: [
                    response.data.users.reserved,
                    response.data.users.not_reserved,
                ],
                backgroundColor: [
                    '#009dd4',
                    '#474343',
                ],
                hoverOffset: 4
            }]
        },
        'doughnut',
        {
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Nombre de Réservations parmis les Users',
                }
            }
        }
    )

    createChart(
        document.getElementById('reservations').getContext('2d'),
        {
            labels: [
                'Theatres',
                'Concerts',
                'OneManShow',
                'Expositions'
            ],
            datasets: [{
                label: 'Evenements',
                data: [
                    response.data.reservations.theatres,
                    response.data.reservations.concerts,
                    response.data.reservations.humours,
                    response.data.reservations.expositions
                ],
                backgroundColor: [
                    '#397367',
                    '#E84855',
                    '#8B5FBF',
                    '#F9DC5C'
                ],
                hoverOffset: 4
            }]
        },
        'doughnut',
        {
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: 'Nombre de Réservations par Type d\'Evenements',
                }
            }
        }
    )
}

function lineChart(response) {

    const reservations = response.data.reservations

    let labels = [];
    let data = [];

    for (const res of reservations) {
        labels.push(res.date);
        data.push(res.count);
    }

    console.log(labels)
    console.log(data)

    createChart(
        document.getElementById('reservations_by_time').getContext('2d'),
        {
            labels: labels,
            datasets: [{
                label: 'Nombres Reservations',
                data: data,
                fill: false,
                borderColor: '#285BE6',
                tension: 0.1
            }]
        },
        'line',
        {
            plugins: {
                legend: {
                    labels: {
                        color: "#FFF",
                    },
                },
                title: {
                    display: false,
                    text: 'Nombre de Réservations par Jours',
                },
            },
            scales: {
                y: {
                    min: 0,
                    ticks: {
                        stepSize: data.length % 100
                    },
                    max: data.length
                }
            }
        }
    )
}


function createChart(ctx, data, type, options = {}) {
    new Chart(ctx, {
        type: type,
        data: data,
        options: options
    });
}