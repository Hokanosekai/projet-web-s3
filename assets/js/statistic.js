document.addEventListener('DOMContentLoaded', async () => {

    await axios.get('/api-count')
        .then(pieChart)

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
                    labels: {
                        color: "#FFF",
                    },
                    position: 'bottom'
                },
                title: {
                    color: "#FFF",
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
                    labels: {
                        color: "#FFF",
                    },
                    position: 'bottom'
                },
                title: {
                    color: "#FFF",
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
                    labels: {
                        color: "#FFF",
                    },
                    position: 'bottom'
                },
                title: {
                    color: "#FFF",
                    display: true,
                    text: 'Nombre de Réservations par Type d\'Evenements',
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