console.log("FILE JS BERHASIL DIMUAT");

console.log(typeof Chart);


/*
========================================
GRAFIK RESERVASI
========================================
*/

const reservationData =
window.reservationChartData;


// array kosong

let reservationLabels = [];

let reservationTotals = [];


// loop data reservasi

reservationData.forEach(function(item){

    reservationLabels.push("Bulan " + item.month);

    reservationTotals.push(item.total);

});


// ambil canvas reservasi

const reservationCtx =
document.getElementById("reservationChart");


// buat chart reservasi

new Chart(reservationCtx, {

    type: "bar",

    data: {

        labels: reservationLabels,

        datasets: [{

            label: "Jumlah Reservasi",

            data: reservationTotals,

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});


/*
========================================
GRAFIK PENDAPATAN
========================================
*/

const revenueData =
window.revenueChartData;


// array kosong

let revenueLabels = [];

let revenueTotals = [];


// loop data pendapatan

revenueData.forEach(function(item){

    revenueLabels.push("Bulan " + item.month);

    revenueTotals.push(item.total);

});


// ambil canvas revenue

const revenueCtx =
document.getElementById("revenueChart");


// buat chart revenue

new Chart(revenueCtx, {

    type: "line",

    data: {

        labels: revenueLabels,

        datasets: [{

            label: "Pendapatan",

            data: revenueTotals,

            borderWidth: 2

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});