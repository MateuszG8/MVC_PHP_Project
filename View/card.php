<?php
function card($row)
{
    echo"<div class='col-xxl-3 col-lg-4 col-md-6 col-xs-12'>
                                    <div class='card' style='width: 18rem; height: 28rem;'>
                                    <img src='".$row['zdjecie']."' class=\"card-img-top\" style='height: 13rem;' alt=\"\">
                                    <div class=\"card-body\" >
                                        <h5 class=\"card-title\">" . $row['nazwa'] . "</h5>
                                        <p class=\"card-text\">Autor przepiu: " . $row['login'] . "</p>
                                        <p class=\"card-text\">Poziom trudności: " . $row['trudnosc'] . "</p>
                                        </div>
                                        <div style='margin-left: 2%; text-align: center;'>
                                        <form method='post' action='../Controller/index.php'>
                                        <input type='submit' name='action' class=\"btn btn-dark\" style='width: 80%;'value='Zobacz przepis'/>
                                        <input type=\"hidden\" name='id' value=".$row['id']." />
                                        </form>
                                       </div>
                                    </div>
                                   </div>";
}
?>