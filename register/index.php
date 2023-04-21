<?php

session_start();

if (isset($_POST['email']))
{
    $user=2;
    $wszystko_OK=true;


    // Sprawdź poprawność adresu email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $wszystko_OK=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }

    //Sprawdź poprawność hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];

    if ($haslo1!=$haslo2)
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $imie=$_POST['imie'];
    $nazwiko=$_POST['nazwisko'];
    $login=$_POST['login'];
    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwiko;
    $_SESSION['fr_login'] = $login;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;

    require_once "../Model/connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $rezultat = $polaczenie->query("SELECT imie FROM uzytkownicy WHERE email='$email'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if($ile_takich_maili>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
            }

            //Czy nick jest już zarezerwowany?
            $rezultat = $polaczenie->query("SELECT id_uzytk FROM uzytkownicy WHERE login='$login'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_nickow = $rezultat->num_rows;
            if($ile_takich_nickow>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Istnieje już użytkownik o takim Loginie! Wybierz inny.";
            }

            if ($wszystko_OK==true)
            {

                $DateAdded = date( 'Y-m-d H:i:s' );

                if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$imie','$nazwiko', '$login', '$haslo_hash', '$email','$user','$DateAdded')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: ../Controller/index.php');
                }
                else
                {
                    throw new Exception($polaczenie->error);
                }

            }

            $polaczenie->close();
        }

    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
        echo '<br />Informacja developerska: '.$e;
    }

}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kuchnia rejestracja</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
        <style>
            .form-control{
                border: 1px solid black;
            }
            .inner{
                background-image: url("images/registration-form-2.jpg");
                background-size: 100%;
                background-repeat: no-repeat;
                padding-top: 20px;
                min-height: 100%;
            }
             .error
             {
                 color:red;
                 margin-top: 10px;
                 margin-bottom: 10px;
             }
        </style>
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');color: black">
			<div class="inner">
				<form method="post" class="needs-validation" validate >
					<h3>Rejestracja</h3>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">Imię</label>
							<input type="text" class="form-control" name="imie" value="<?php
                            if (isset($_SESSION['fr_imie']))
                            {
                                echo $_SESSION['fr_imie'];
                                unset($_SESSION['fr_imie']);
                            }
                            ?>"  required >
						</div>
						<div class="form-wrapper">
							<label for="">Nazwisko</label>
							<input type="text" class="form-control" name="nazwisko" value="<?php
                            if (isset($_SESSION['fr_nazwisko']))
                            {
                                echo $_SESSION['fr_nazwisko'];
                                unset($_SESSION['fr_nazwisko']);
                            }
                            ?>"  required>
						</div>
					</div>
                    <div class="form-wrapper">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php
                        if (isset($_SESSION['fr_email']))
                        {
                            echo $_SESSION['fr_email'];
                            unset($_SESSION['fr_email']);
                        }
                        ?>"  required>
                        <?php
                        if (isset($_SESSION['e_email']))
                        {
                            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
                        ?>
                    </div>
                    <div class="form-wrapper">
                        <label for="">Login</label>
                        <input type="text" class="form-control" name="login" value="<?php
                        if (isset($_SESSION['fr_login']))
                        {
                            echo $_SESSION['fr_login'];
                            unset($_SESSION['fr_login']);
                        }
                        ?>"  required>
                        <?php
                        if (isset($_SESSION['e_nick']))
                        {
                            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                            unset($_SESSION['e_nick']);
                        }
                        ?>
                    </div>
					<div class="form-wrapper">
						<label for="">Hasło</label>
						<input type="password" class="form-control" name="haslo1" value="<?php
                        if (isset($_SESSION['fr_haslo1']))
                        {
                            echo $_SESSION['fr_haslo1'];
                            unset($_SESSION['fr_haslo1']);
                        }
                        ?>"  required>
					</div><?php
                    if (isset($_SESSION['e_haslo']))
                    {
                        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                        unset($_SESSION['e_haslo']);
                    }
                    ?>
                    <div class="form-wrapper">
						<label for="">Potwierdź hasło</label>
						<input type="password" class="form-control" name="haslo2" value="<?php
                        if (isset($_SESSION['fr_haslo2']))
                        {
                            echo $_SESSION['fr_haslo2'];
                            unset($_SESSION['fr_haslo2']);
                        }
                        ?>"  required>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" required >Akceptuję warunki użytkowania i politykę prywatności.
							<span class="checkmark" required></span>
						</label>
					</div>
					<button>Zarejestruj sie</button>
				</form>
			</div>
		</div>
		
	</body>
</html>