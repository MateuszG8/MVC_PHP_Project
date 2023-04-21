<?php
function show_przepis($row)
{
    echo '
                        <div class="text-center">
                            <img src="' . $row['zdjecie'] . '" class="img-fluid" style="max-height: 500px;" alt="Przepis">
                        </div>
                        <div class="text-center"><h1>' . $row['nazwa'] . '</h1></div>
                        <div class="text-center"><div><h3>Autor</h3>' . $row['login'] . '</div><div><h3>Porcje</h3>' . $row['porcje'] . '</div><div><h3>Poziom trudności</h3>' . $row['trudnosc'] . '</div></div>
                        <div class="text-center"><h3>Składniki</h3>' . $row['skladniki'] . '</div>
                        <div class="text-center" style="padding-bottom: 5%"><h3>Sposób przygotowania</h3>' . $row['przepis'] . '</div>';
}

?>