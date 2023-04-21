<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<?php
session_start();
include "../Model/Recipes.php";
include "../Model/Baza.php";
$bd = new Baza();
function view($x){
    switch ($x) {
        case 0:
            include "../View/title_image.php";
            include "../View/przepisy_section_start.php";
            if(isset($_GET['czy'])){
                $stmt = Recipes::getSearchedRecipes($GLOBALS['bd'],$_GET['czy']);
            }else if(isset($_SESSION['Category'])&&($_SESSION['Category']>0)){
                $stmt = Recipes::getCategory($GLOBALS['bd'],$_SESSION['Category']);
            }else if((isset($_SESSION['Owner']))&&($_SESSION['Owner']>0)){
                $stmt = Recipes::showUserRecipes($GLOBALS['bd'],$_SESSION['id']);
            }else{
                $stmt = Recipes::getAllRecipes($GLOBALS['bd']);
            }
            include "../View/card.php";
            include "../View/card_owner.php";
            $i = 0;
            foreach ($stmt as $row) {
                $i++;
                if((isset($_SESSION['id']))&&(($_SESSION['id'])==$row['autor'])){
                    card_owner($row);
                }else{
                    card($row);
                }

            }
            if ($i == 0) {
                echo "Nie ma co wyswietlac";
            }
            include "../View/przepisy_section_end.php";
            $_SESSION['Category']=0;
            $_SESSION['Owner']=0;
            break;
        case 1:
            include "../View/dodaj_przepis.php";
            $_SESSION['View']=0;
            break;
        case 2:
            include "../View/przepis.php";
            include "../View/opinie.php";
            if(isset($_POST['id'])){
                $_SESSION['rid']=$_POST['id'];
            }
            $stmt = Recipes::showRecipebyID($GLOBALS['bd'],$_SESSION['rid']);
            $opinie = Recipes::showOpinions($GLOBALS['bd'],$_SESSION['rid']);
            $row = $stmt->fetch_assoc();
            show_przepis($row);
            $i = 0;
            if(isset($_SESSION['zalogowany'])) {
                show_opinions_logged();
            }
            show_opinions_header();
            foreach ($opinie as $op) {
                $i++;
                show_opinions($op);
            }
            show_opinions_footer();
            if ($i == 0) {
                echo "<div class='text-center'><h3>Brak</h3></div>";
            }

            $_SESSION['View']=0;
            break;
        case 3:
            $id = $_POST['id'];
            $_SESSION['rid']=$id;
            include "../View/edycja.php";
            $stmt = Recipes::showRecipebyID($GLOBALS['bd'],$id);
            $row = $stmt->fetch_assoc();
            echo $row['przepis'];
            edycja($row);
            $_SESSION['View']=0;
    }

}
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    include "../View/header_login.php";
    if (filter_input(INPUT_POST, "submit")) {
        $akcja = filter_input(INPUT_POST, "submit");
        $autor=$_SESSION['id'];
        $nazwa=$_POST['nazwa'];
        $opis=$_POST['opis'];
        $skladniki=$_POST['skladniki'];
        $kategoria=$_POST['kategoria'];
        $porcje=$_POST['porcje'];
        $trudnosc=$_POST['trudnosc'];
        $zdjecie=$_POST['zdjecie'];
        switch ($akcja) {
            case "Dodaj przepis" :
                $przepis = new Recipes($nazwa,$autor,$kategoria,$opis,$skladniki,$porcje,$trudnosc,$zdjecie);
                $przepis->addToDB($bd);
                break;
            case "Edytuj przepis" :
                Recipes::updateRecipe($bd, $_SESSION['rid'],$nazwa, $autor, $kategoria, $opis, $skladniki, $porcje, $trudnosc, $zdjecie);
                $_SESSION['Owner']=1;
                break;
            case "Usuń przepis" :
                Recipes::deleteRecipe($bd, $_SESSION['rid']);
                $_SESSION['Owner']=1;
                break;
        }
    }
    if(isset($_POST['Opinia'])){
        $autor=$_SESSION['id'];
        $ocena=$_POST['ocena'];
        $id_przepisu=$_SESSION['rid'];
        $opinia=$_POST['opis'];
        Recipes::addOpinion($bd,$autor,$id_przepisu,$ocena,$opinia);
        $_SESSION['View']=2;
    }

} else if (isset($_SESSION['blad']) && ($_SESSION['blad'] == true) && ($_SESSION['blad_n'] == true)) {
    echo "<script type='text/javascript'>
        $(document).ready(function(){
        $('#exampleModal').modal('show');
        });
        </script>";
    $_SESSION['blad_n'] = false;
}

if (!(isset($_SESSION['zalogowany']))) {
    include "../View/header.php";
}
//Pokaz przepis
if(isset($_POST['action']) && isset($_POST['id'])){
    $_SESSION['View']=2;
}
if(isset($_POST['edit']) && isset($_POST['id'])){
    $_SESSION['View']=3;
}
View($_SESSION['View']);

include "../View/footer.php";
