<?php

    session_start();

    include "../Model/Baza.php";
    $connect = new Baza();
        $login=$_POST['login'];
        $password=$_POST['password'];

        $sql = "SELECT * FROM uzytkownicy WHERE login='$login'";

        if ($result = $connect->select($sql)) {
            $ilu_userow = $result->num_rows;
            if ($ilu_userow > 0) {

                $wiersz = $result->fetch_assoc();

                if (password_verify($password, $wiersz['haslo'])){
                    $_SESSION['zalogowany']=true;
                    $_SESSION['imie'] = $wiersz['imie'];
                    $_SESSION['id'] = $wiersz['id_uzytk'];

                    $_SESSION['blad']=false;
                    $_SESSION['blad_n'] = false;
                    $result->free_result();
                    header('Location:../Controller/index.php');
                }else{
                    $_SESSION['blad'] = true;
                    $_SESSION['blad_n'] = true;
                    header('Location:../Controller/index.php');
                }

            }
             else{
                 $_SESSION['blad'] = true;
                 header('Location:../Controller/index.php');
             }

        }

?>