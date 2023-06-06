// Variables de los botones
$show = document.getElementById("show");
$hide = document.getElementById("hide");
$table = document.getElementById("users");

// Enseñar la tabla
function showTable() {
    $table.style.display = "block";
    $show.style.display = "none";
    $hide.style.display = "block";
}

// Ocultar la tabla
function hideTable() {
    $table.style.display = "none";
    $show.style.display = "block";
    $hide.style.display = "none";
}