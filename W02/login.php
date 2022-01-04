<?php

$error = '';
$message = '';


// Formular wurde gesendet und Besucher ist noch nicht angemeldet.
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)){
	// username
	if(!empty(trim($_POST['username']))){

		$username = trim($_POST['username']);
		
		// prüfung benutzername
		if(!preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}/", $username) || strlen($username) > 30){
			$error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
		}
	} else {
		$error .= "Geben Sie bitte den Benutzername an.<br />";
	}
	// password
	if(!empty(trim($_POST['password']))){
		$password = trim($_POST['password']);
		// passwort gültig?
		if(!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
			$error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
		}
	} else {
		$error .= "Geben Sie bitte das Passwort an.<br />";
	}
	
	// kein fehler
	if(empty($error)){
      $host     = 'localhost';       // host
      $username = 'tester';            // username
      $password = '1234';        // Passwort (brauchen Sie nie dieses Passwort)
      $database = 'm151';   // database

      $conn = mysqli_connect($host, $username, $password, $database);

      if (!$conn) {
          die("Verbindung misslungen: " . mysqli_connect_error());
      }
      echo "Verbindung erfolgreich";
        $username = $_POST['username'];
        $password = $_POST['password'];

      $stmt = $conn->prepare("SELECT username, password from users where username = ?;");
      $stmt->bind_param("s", $username);

      $stmt->execute();

      $result = $stmt->get_result();

      $row = $result->fetch_assoc();
      if($row['password'] != $password || empty($row['username'])){
          $error .= "Benutzername oder Passwort sind falsch";
      }else{
          $message .= "Sie sind nun eingeloggt";
      }


        // TODO SELECT Query erstellen, user und passwort mit Datenbank vergleichen
        // TODO prepare()
		// TODO bind_param()
		// TODO execute()
		// TODO Passwort auslesen und mit dem eingegeben Passwort vergleichen
		// TODO wenn Passwort korrekt:  $message .= "Sie sind nun eingeloggt"; 
		// TODO wenn Passwort falsch, oder kein Benutzer mit diesem Benutzernamem in DB: $error .= "Benutzername oder Passwort sind falsch";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<div class="container">
			<h1>Login</h1>
			<p>
				Bitte melden Sie sich mit Benutzernamen und Passwort an.
			</p>
			<?php
				// fehlermeldung oder nachricht ausgeben
				if(!empty($message)){
					echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
				} else if(!empty($error)){
					echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
				}
			?>
			<form action="" method="POST">
				<div class="form-group">
				<label for="username">Benutzername *</label>
				<input type="text" name="username" class="form-control" id="username"
						value=""
						placeholder="Gross- und Keinbuchstaben, min 6 Zeichen."
						maxlength="30" required="true"
						pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
						title="Gross- und Keinbuchstaben, min 6 Zeichen.">
				</div>
				<!-- password -->
				<div class="form-group">
					<label for="password">Password *</label>
					<input type="password" name="password" class="form-control" id="password"
							placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
							pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
							title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
							required="true">
				</div>
		  		<button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
		  		<button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
			</form>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>

