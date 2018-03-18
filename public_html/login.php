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

        <!-- Card Container -->  
        <div class="container" id="cardcontainer">
            <div class="card" style="margin-top: 10%;;margin-bottom: 10%;">
                <div class="card-body">

                    <!-- Login Form -->
                    <form action="loginvalidation.php" method="POST">

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="username" class="form-control" name="userinput" aria-describedby="emailHelp" placeholder="username">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passinput" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        
                    </form>
                    <!-- Login Form End -->
                
                </div>
            </div>
        </div>
        <!-- Card Container End --> 

        <?php include("footer.php"); ?>

    </body>
</html>