<?php
include('../../../core/main.class.php');
$main = new Main;

$action = Security::secureString($_GET['action']);
switch ($action) {
    case 'signup':
        $username = strtolower(Security::secureString($_GET['username']));
        $email = strtolower(Security::secureString($_GET['email']));
        $password = Security::secureString($_GET['password']);
        $rpassword = Security::secureString($_GET['rpassword']);
        if ($password == $rpassword)
            $pass = md5($password);
        else
            $msg='The passwords did not match!';
        if ($main->con()->db_query("INSERT INTO members (username,email,password,joindate) VALUES('$username','$email','$pass',NOW())"))
            $msg = 'The user was created!';
        echo $msg;
        break;
    case'login':
        $username = strtolower(Security::secureString($_GET['username']));
        $password = md5(Security::secureString($_GET['password']));

        $error = '0';
        $msg = '';
        $admin = false;

        $sql_check = $main->con()->db_query("SELECT username,password,id,admin FROM members WHERE username='$username' AND password='$password'");

        if (mysql_num_rows($sql_check)) {
            $row = mysql_fetch_assoc($sql_check);
            session::start_secure_session();
            session::add_param("admin", $row['admin']);
            session::add_param("user_id", $row['id']);
            session::add_param("username", $username);
        } else {
            $error = '1';
            $msg = 'Acest user nu exista!';
        }

        echo '&error=' . $error . '&msg=' . $msg;
        break;
    case 'logout':
        session::destroy();
        break;
    default:
        echo 'Oppsssyyy!';
        break;
}
?>

