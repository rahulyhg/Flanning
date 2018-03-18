<?php
    session_start();

    if (!isset($_SESSION['login_user'])) {
        header('Location: login.php');
    } else {
        $logged_user = $_SESSION['login_user'];
        $connection = mysqli_connect("127.0.0.1", "", "", "my_flanning");
        $user_info = "SELECT * FROM User WHERE mail='$logged_user'";
        $groups_brief = "SELECT ug.id AS ugid, COUNT(*) AS members, p.description AS groupname FROM User u JOIN UserGroupLookup ugl ON u.id = ugl.user JOIN UserGroup ug ON ug.id = ugl.usergroup JOIN Subscription s ON ug.id = s.usergroup JOIN Plan p ON s.plan = p.id WHERE type = 'O' GROUP BY groupname, ugid";
        $services = "SELECT DISTINCT p.description AS groupname FROM User u JOIN UserGroupLookup ugl ON u.id = ugl.user JOIN UserGroup ug ON ug.id = ugl.usergroup JOIN Subscription s ON ug.id = s.usergroup JOIN Plan p ON s.plan = p.id WHERE u.mail = '$logged_user'";
        $user_info_result = mysqli_query($connection, $user_info);
        $groups_brief_result = mysqli_query($connection, $groups_brief);
        $services_result = mysqli_query($connection, $services);
        $user_info_result_assoc = mysqli_fetch_assoc($user_info_result);
    }
?>

<!DOCTYPE HTML>
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

        <?php include("navbar.php") ?>

        <div class="container">
            <div class="card" style="margin-top: 10%;;margin-bottom: 10%;">
                <div class="card-body">

                    <div class="container" id="cardcontainer">
                        <div class="row">
                            <div class="col-sm text-center">         
                                <img src="https://ssl.gstatic.com/images/branding/product/1x/avatar_circle_blue_512dp.png" height="150" style="margin-bottom:5%;">
                            </div>
                            <div class="col-sm">
                                <!-- User Info Table -->
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $user_info_result_assoc["name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $user_info_result_assoc["surname"]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo $user_info_result_assoc["mail"]; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- User Info Table End -->
                            </div>
                        </div>
                    </div>



                    <!-- User Groups Brief Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Gruppo
                                </th>
                                <th>
                                    Membri
                                </th>
                                <th>
                                    Info
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($row = mysqli_fetch_assoc($groups_brief_result)) {
                                    ?>
                                    <tr>
                                        <td> 
                                            <?php echo $row['groupname'];?> 
                                        </td>
                                        <td> 
                                            <?php echo $row['members'];?> 
                                        </td>
                                        <td> 
                                            <form action="group.php" method="POST">
                                                <input value="<?php echo $row['ugid'];?> " type = "hidden" name="groupid"/>
                                                <input class="btn" type="submit" value="+" />
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <!-- User Groups Brief Table End -->

                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

    </body>

</html>