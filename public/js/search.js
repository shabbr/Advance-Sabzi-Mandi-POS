    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const tableRows = document.querySelectorAll(".table tbody tr");

        searchInput.addEventListener("input", function() {
            const query = this.value.toLowerCase();

            tableRows.forEach(row => {
                const columns = row.querySelectorAll("td");
                let found = false;

                columns.forEach(column => {
                    if (column.textContent.toLowerCase().includes(query)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
