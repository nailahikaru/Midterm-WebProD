document.addEventListener('DOMContentLoaded', function() {
    
    // FITUR LIVE SEARCH
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('scheduleBody');
    const noResults = document.getElementById('noResults');
    
    if (searchInput && tableBody) {
        // Ambil baris tabel (hanya baris <tr> di dalam <tbody>)
        const rows = tableBody.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                // Pastikan baris ini bukan baris "No schedules found"
                if (rows[i].getElementsByTagName('td')[0]) {
                    const rowText = rows[i].textContent.toLowerCase();
                    
                    if (rowText.includes(filter)) {
                        rows[i].style.display = "";
                        visibleCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }

            // Tampilkan pesan jika tidak ada hasil
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        });
    }
});