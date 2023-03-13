<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Student Information</title>
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

        td, th {
            text-align: center;
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
                        <li class="nav-item nav-btn rounded" style="background-color: #16a085;">
                            <a class="nav-link text-light" aria-current="page" href="success.php">Home</a>
                        </li>
                        <li class="nav-item nav-btn rounded">
                            <a class="nav-link " href="index.php">Add student</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex justify-content-center">
            <div class="col-md-4">
            <?php
        if (isset($_SESSION['submitError'])) {
            echo $_SESSION['submitError'];
        }
        unset($_SESSION['submitError']);
        ?>
            </div>
        </div>

        <div class="container py-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Picture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // read users data from CSV file
                    $file = fopen('users.csv', 'r');

                    while (($data = fgetcsv($file)) !== false) {
                        echo '<tr>';
                        echo '<td>' . $data[0] . '</td>';
                        echo '<td>' . $data[1] . '</td>';
                        echo '<td><img width="70px" src="uploads/' . $data[2] . '"></td>';
                        echo '</tr>';
                    }

                    fclose($file);
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>