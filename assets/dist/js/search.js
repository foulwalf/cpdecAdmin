function search() {
    // Declare variables
    var input, filter, table, tr, a, i, txtValue;
    input = document.getElementById('myInput');
    filter = input.value;

    table = document.getElementById("myTable");
    tr = table.getElementsByTagName('tr');
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        a = tr[i].getElementsByTagName("td")[2];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}