<?php
    session_start();


    if (!isset($_SESSION['login_user'])) {
        header('Location: login.php');
    } else {
        $logged_user = $_SESSION['login_user'];
        $selectedgroup = $_POST['groupid']; 
        $connection = mysqli_connect("127.0.0.1", "", "", "my_flanning");
        if (!$connection) {
            die('Errore di connessione: ' . mysqli_connect_error());
        }
        $select_members = "SELECT name, surname FROM User u JOIN UserGroupLookup UGL ON u.id = UGL.user WHERE UGL.usergroup = $selectedgroup AND type = 'O';";
        $select_members_result = mysqli_query($connection, $select_members);
        $select_user_payments = "SELECT date, amount FROM User JOIN Payment ON User.id = Payment.user JOIN UserGroup ON UserGroup.id = Payment.usergroup WHERE User.mail = '$logged_user' AND UserGroup.id = $selectedgroup";
        $select_user_payments_result = mysqli_query($connection, $select_user_payments);
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">

    <!-- Responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS import -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- JQuery import -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!-- Popper import (What the hell is popper?) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Bootstrap JS import -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title> Flanning </title>
    </head>
    <body>

        <?php include("navbar.php"); ?>

        <div class="container" id="cardcontainer">
            <div class="card" style="margin-top: 10%;margin-bottom: 10%;">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan = 2 class="text-center">
                                    Membri
                                </th>
                            </tr>
                            <tr>
                                <th scope="col"> 
                                    Nome 
                                </th>
                                <th scope="col"> 
                                    Cognome 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($select_members_result)) {
                            ?>
                            <tr>
                                <td> 
                                    <?php echo $row['name'];?> 
                                </td>
                                <td> 
                                    <?php echo $row['surname'];?> 
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                        </tbody>
                    </table>
                    <?php
                    ?>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan = 2 class="text-center">
                                                Pagamenti
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col"> 
                                                Data 
                                            </th>
                                            <th scope="col"> 
                                                Ammontare 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                    while ($row = mysqli_fetch_assoc($select_user_payments_result)) {
                                        ?>
                                        <tr>
                                            <td> 
                                                <?php echo $row['date'];?> 
                                            </td>
                                            <td> 
                                                <?php echo $row['amount'];?> 
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan = 2 class="text-center">
                                                Fatture
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                    while ($row = mysqli_fetch_assoc($select_members_result)) {
                                        ?>
                                        <tr>
                                            <td> 
                                                <?php echo $row['name'];?> 
                                            </td>
                                            <td> 
                                                <?php echo $row['surname'];?> 
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                    <form action="index.php" class="text-center">
                        <input class="btn" type="submit" value="Home" />
                    </form>

                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>