<?php
include "includes/connect.php";

// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }

// // Retrieve the username from the session
// $username = $_SESSION['username'];


// Check if the room number is provided (assuming it comes from a form submission)
if (isset($_POST['search'])) {
    $room = $_POST['roomnum'];

    // Query to check user credentials
    $query = "SELECT * FROM passkeys WHERE roomno = '$room'";
    $result = mysqli_query($con, $query);

    // Check if the result was found
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        $room = $data['roomno'];
        $pass = $data['password'];
        $usern =$data['username'];
        
    } else {
        echo "<script>alert('Not found');</script>";
    }
}

?>
 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="style/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="style/style.css" media="print">
        <link rel="stylesheet" href="style/font-awesome/fonts/fontawesome-webfont.woff">
        <link rel="stylesheet" href="style/font-awesome/fonts/fontawesome-webfont.svg">
        <link rel="stylesheet" href="style/font-awesome/fonts/fontawesome-webfont.woff">
        <link rel="stylesheet" href="style/font-awesome/fonts/fontawesome-webfont.woff2">
        <link rel="stylesheet" href="style/font-awesome/fonts/fontawesome-webfont.eot">
        <link rel="stylesheet" href="style/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="style/font-awesome/css/font-awesome.min.css">
        <link rel="icon" type="image/x-icon" href="includes/favicon.ico">
    </head>
    <body style="background-color: #08415c;">
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-warning">
            <div class="container-fluid">
                <p><h3>Hello, <?php
                        $currentHour = date('H');

                        if ($currentHour >= 5 && $currentHour < 12) {
                            echo "Good morning!";
                        } elseif ($currentHour >= 12 && $currentHour < 18) {
                            echo "Good afternoon!";
                        } else {
                            echo "Good evening!";
                        }
                        ?>
                                </h3></p> <br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <!-- <a href="logout.php?logout=true">Logout</a> -->
                    </li>
                    <li class="nav-item">
                    <!-- <a href="insert.php">Upload</a> -->
                    <p></p>
                    </li>
                    <li class="nav-item dropdown">
                </ul> 
                <form class="d-flex" role="search"  method="post">
                    <input class="form-control me-1" type="search" placeholder="Enter Room number" aria-label="Search" name="roomnum" size="35" required>
                    <input type="submit" name="search">
                </form>
                </div>
            </div>
        </nav>

    <div class="center">
            
                <h1>WIFI DETAILS</h1>
                <form id="print-area">
                    <div class="txt_field">
                        <label>Room Number</label><br>
                        <input type="text" value="<?php echo isset($room) ? $room : ''; ?>" readonly>
                        <span></span>
                    </div>
                    <br>

                    <div class="txt_field">
                        <label>Username</label>
                        <input type="text" value="<?php echo isset($usern) ? $usern : ''; ?>" readonly>
                        <span></span>
                    </div>
                    <br>

                    <div class="txt_field">
                        <label>Password</label>
                        <input type="text" value="<?php echo isset($pass) ? $pass : ''; ?>" readonly>
                        <span></span>
                    </div>
                    <br>
           
                    
                    <p class="font-weight-bold">Powered by Arathorn</p>
                </form>
                
                <input type="submit" value="PRINT" onclick="printArea()">
                
    </div>

     </body>
     <style>
        .center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: white;
        border-radius: 20px;
        box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
        padding: 10px, 20px;
        }

        .center h1{
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid silver;
        }

        .center form{
        padding: 10px 40px;
        /* box-sizing: border-box; */
        }

        /* form .txt_field{
        position: relative;
        border-bottom: 5px solid #adadad;
        margin: 30px 0;
        } */

        .txt_field input{
        width: 100%;
        padding:  3px;
        height: 40px;
        border-radius: 5px;
        border-color: #08415c;
        /* font-size: 16px;
        border: 5px;
        border-radius: 10px;
        border-color: #08415c; */
        }
        .txt_field label{
        top: 50%;
        /* left: 5px; */
        color: #08415c;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        transition: .5s;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        /* .txt_field span::before{
        content: '';
        position: absolute;
        top: 40px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #2691d9;
        transition: .5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
        top: -5px;
        color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
        width: 100%;
        } */

        input[type="submit"]{
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 700;
        cursor: pointer;
        outline: none;
        }
        input[type="submit"]:hover{
        border-color: #2691d9;
        transition: .5s;
        }

        /* .pass{
        margin: -5px 0 20px 5px;
        color: #a6a6a6;
        cursor: pointer;
        }
        .pass:hover{
        text-decoration: underline;
        } */
     </style>
    <script>
        function printArea() {
        var printContents = document.getElementById("print-area").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
        }
    </script>


</html>