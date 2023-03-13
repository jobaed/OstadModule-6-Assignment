<?php
session_start();
// Get Submit Data
if (isset($_POST['submit'])) {

    // Vallidate User Data
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['profile_pic'])) {
        $_SESSION['fieldsRequired'] = '<div class="alert alert-danger" role="alert">
        Your Fields Are Required;
      </div>
      ';
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_pic = $_FILES['image'];

    // Filter Email Address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['submitError'] = '<div class="alert alert-danger" role="alert">
        Invallid Email.
      </div>
      ';
    }

    // save profile picture to server
    $upload_dir = 'uploads/';
    $filename = date('Y-m-d_H-i-s') . '_' . $profile_pi['name'];

    if (!move_uploaded_file($profile_pic['tmp_name'], $upload_dir . $filename)) {
        $_SESSION['submitError'] = '<div class="alert alert-danger" role="alert">
        Something Went Worng.
      </div>
      ';
    } else {
        // save user's data to CSV file
        $data = array($name, $email, $filename);
        $file = fopen('users.csv', 'a');

        if (fputcsv($file, $data) === false) {
            $_SESSION['submitError'] = '<div class="alert alert-danger" role="alert">
                                            Writing Error.
                                        </div>
      ';
        } else {
            fclose($file);

            // start session and set cookie
            setcookie('username', $name);

            $_SESSION['submitError'] = '<div class="alert alert-success" role="alert">
                                        Data Added Successfull.
                                    </div>';

            // redirect to success page
            header('Location: success.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add Students</title>

    <style>
        .nav-btn {
            border: 1px solid gray;
            margin: 0 10px;
            padding: 0px 20px;
            color: black;
            font-weight: 600;
            text-transform: uppercase;
        }

        .nav-btn:hover {
            background-color: #16a085;
            transition: all 1s;
            border: 1px solid #16a085;
        }

        .nav-btn:hover>a {

            color: white !important;
        }
    </style>
</head>

<body>

    <div class="container pt-4">
        <nav class="navbar navbar-expand-lg  m-0">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#" style="color: #16a085; font-size: 30px;">STUDENT ZONE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center">
                        <li class="nav-item nav-btn rounded">
                            <a class="nav-link" aria-current="page" href="success.php">Home</a>
                        </li>
                        <li class="nav-item nav-btn rounded" style="background-color: #16a085;">
                            <a class="nav-link text-light" href="add.php">Add student</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-3">
            <div class="d-flex justify-content-center py-5 shadow rounded">
                <div class="col-md-6">
                    <?php

                    if (isset($_SESSION['submitError'])) {
                        echo $_SESSION['submitError'];
                    }
                    unset($_SESSION['submitError']);

                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="my-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Your Name" required>
                        </div>
                        <div class="my-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                        <div class="my-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                        </div>
                        <div class="my-3">
                            <label for="profile_pic" class="form-label">Profile Picture:</label>
                            <input type="file" class="form-control" name="image" id="profile_pic" required>
                        </div>
                        <input type="submit" name="submit" class="btn  btn-success px-5" value="Submit">
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>