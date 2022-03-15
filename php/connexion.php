<?php
session_start();

$username = "";
$email ="";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'connxion');
if($_SERVER['REQUEST_METHOD'] == "POST"):
    if(isset($_POST['sent'])):
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['user_password_signup']);

        if(empty($username)):
            array_push($errors, "Veuillez entrer votre nom d'utilisateur");
        endif;
        if(empty($email)):
            array_push($errors, "Veuillez entrer votre email");
        endif;
        if(empty($password)):
            array_push($errors, "Veuillez entrer votre mot de passe");
        endif;

        $user_check = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check);
        $user = mysqli_fetch_assoc($result);

        if($user):
            if($user['username' == $username]):;
                array_push($errors, "Ce nom d'utilisateur existe deja.");
            endif;
            if($user['email'] == $email):
                array_push($errors, "Cette email existe deja.");
            endif;
        endif;
        if(count($errors) == 0):
            $request2 = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
            $exec = mysqli_query($db, $request2);
            $_SESSION['username'] = $username;
            $_SESSION['succes'] = "Vous etes connectes";
        endif;
    endif;
    header('Refresh= 1; URL=Projet SEO/index.html');
endif;
?>

<?php
if(isset($_POST['sent-login'])):
    $username = mysqli_real_escape_string($db, $_POST['user_name']);
    $password = mysqli_real_escape_string($db, $_POST['user_password']);

    if(empty($username)):
        array_push($errors, "Veuillez entrer votre nom d'utilisateur");
    endif;

    if(empty($password)):
        array_push($errors, "Veuillez entrer votre mot de passe");
    endif;

    if(count($errors) == 0):
        $request3 = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $exec2 = mysqli_query($db, $request3);
        if(mysqli_num_rows($exec2) == 1):
            $_SESSION['username'] = $username;
            $_SESSION['succes'] = "Vous etes connectes";
            header('Refresh= 3; URL=/Projet SEO/index.html');
        endif;
    endif;
endif;
?>