// penghitungan pembayaran
function calculatePrice()
{
    let startDate =
        document.getElementById('start_date').value;

    let endDate =
        document.getElementById('end_date').value;

    let price =
        parseInt(document.getElementById('price').value);

    let category =
        document.getElementById('category').value;

    if(startDate && endDate)
    {
        let start =
            new Date(startDate);

        let end =
            new Date(endDate);

        let diffTime =
            end - start;

        let diffDays =
            (diffTime / (1000 * 60 * 60 * 24)) + 1;

        let total = 0;

/*
KAMAR PUTRA / PUTRI
hitung per bulan
*/
        if(category === 'Kamar Putra'
           || category === 'Kamar Putri')
        {
            let months =
                Math.ceil(diffDays / 30);

            total = months * price;
        }

/*
KAMAR TAMU / PARKIR
hitung per hari
*/
        else
        {
            total = diffDays * price;
        }


        document.getElementById('total_price').value =
            total;
    }
}


document.getElementById('start_date')
        .addEventListener('change', calculatePrice);

document.getElementById('end_date')
        .addEventListener('change', calculatePrice);

