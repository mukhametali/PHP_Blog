<?php

if (!empty($_POST))
{
    //validate
    $errors = [];

    $query = "select * from users where email = :email limit 1";
    $row = query($query, ['email' =>$_POST['email']]);

    if ($row)
    {
        //check passwd
        $data = [];
        if(password_verify($_POST['password'], $row[0]['password']))
        {
            //grant access
            authenticate($row[0]);
            redirect('admin');

        }else{
            $errors['email'] = "Wrong email or password";
        }

    }else{
        $errors['email'] = "Wrong email or password";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login - <?= APP_NAME ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <form method="post">
        <a href="home">
            <img class="mb-4 rounded-circle shadow" src="<?=ROOT?>/assets/images/logo.jpg" alt="" width="92" height="92" style="object-fit: cover">
        </a>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <?php if(!empty($errors['email'])):?>
            <div class="alert alert-danger"><?=$errors['email']?></div>
        <?php endif;?>

        <div class="form-floating">
            <input value="<?=old_value('email')?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input value="<?=old_value('password')?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="my-2">Don't have account? <a href="<?=ROOT?>/signup">Signup here</a></div>
        <div class="checkbox mb-3">
            <label>
                <input name="remember" type="checkbox" value="1"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y")?></p>
    </form>
</main>



</body>
</html>

