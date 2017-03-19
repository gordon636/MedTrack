<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MedTrack</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../views/style.css">
    </head>

    <?php 
    require_once 'init.php';
    require_once 'models/database.php';
    $db = databaseConnection();
    $client = new Google_Client();

    $auth = new GoogleAuth($db, $client);


    $plus = new Google_Service_Plus($client);

    if (isset($_REQUEST['logout'])) {
       session_unset();
    }

    if ($auth->checkRedirectCode($plus)) {
      $client->authenticate($_GET['code']);
      $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
      header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    }

    if ($auth->isLoggedIn()) {
        $client->setAccessToken($_SESSION['access_token']);
        $me = $plus->people->get('me');
        // Get User data
        $id = $me['id'];
        $name =  $me['displayName'];
        $email =  $me['emails'][0]['value'];
        $profile_image_url = $me['image']['url'];
        $cover_image_url = $me['cover']['coverPhoto']['url'];
        $profile_url = $me['url'];

        require_once '../models/googleUser_model.php';   
        $checkUser = new GoogleUser($db);
        if ($checkUser->checkPrivileges($email) >= 1){
            $privileges = True;
        }else {
            $privileges = False;
        }

        $_SESSION['privileges'] = $privileges;

    } else {
      // get the login url   
      $authUrl = $client->createAuthUrl();
      $privileges = False;
      $_SESSION['privileges'] = $privileges;

    }
    ?>

            <div class="container">
                <header class="page-header">
                    <?php 
                        echo "<a href= ../><h1>Medfield Track and Field</h1></a>";
                    ?>
                </header>
                <ul>
                    <?php echo "<li><a href= index.php?team=" . urlencode("medfield") . "&s=" . urlencode("m") . "> Men's Team </a></li>";
                        echo "<li><a href= index.php?team=" . urlencode("medfield") . "&s=" . urlencode("f") . "> Women's Team </a></li>";
                    ?>
                    <li><?php echo "<a href= index.php?viewMeets> Recent Meets </a>"; ?></li>
                    <?php if($_SESSION['privileges']): ?>
                    <li><?php echo "<a href= index.php?vip= " . urlencode(True) . " > Add Results </a>"; ?></li>
                    <?php endif; ?>
                    <li><?php
                            if ($privileges == False && !$auth->isLoggedIn()) {
                                echo "<a class='login' href='" . $authUrl . "'>Sign in with Google</a>";
                            } else {
                                echo "<a class='logout' href='logout.php?privileges=yes'>Logout</a>  <img src=$profile_image_url>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        <body>