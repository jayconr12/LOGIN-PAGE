<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF 8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <?php
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            ?>
            <?php
           //validate the submit button
           if(isset($_POST["submit"])){
            $LastName = $_POST["LastName"];
            $FirstName = $_POST["FirstName"];
            $email = $_POST["Email"];
            $password = $_POST["password"];
            $RepeatPassword = $_POST["repeat_password"];
            $errors = array ();
            //validate the submit button
            if (empty($LastName) OR empty($FirstName) OR empty($email) OR empty($password) OR empty($RepeatPassword)){
                array_push($errors, "All fields are required");
            }
            // validate if all fields are empty
            if(!filter_var(value: $email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
                //validate if email is not validated
                if(strlen($password)<8){
                    array_push($errors, "Password must be at least 8 characters long");
                   }
                   //password should not be less than 8
                   if($password!= $RepeatPassword){
                    array_push($errors, "Password does not match");
                   }
                   // check if password is the same
                   if(count($errors)>0){
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>">
                    }
                } else {
                    //Insert to database
                }
                   }
            ?>
        <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="LastName" placeholder="LastName: ">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="FirstName" placeholder="FirstName: ">
         <div class="form-group">
            <input type="email" class="form-control" name="Email" placeholder="Email: ">
        </div>
        <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Input Password: ">
        </div>
        <div class="form-group">
             <input type="text" class="form-control" name="repeat_password" placeholder="Repeat Password: ">
        </div>
        <div class="form-btn">
             <input type="submit"name="submit" class="btn btn-primary" value="Register">
          </div>
        </form>
    </div>
</body>
</html>
