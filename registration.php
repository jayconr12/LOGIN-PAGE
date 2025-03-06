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
            print_r($_POST);
            ?>
            <?php
           
           if(isset($_POST["submit"])){
            $LastName = $_POST["LastName"];
            $FirstName = $_POST["FirstName"];
            $email = $_POST["Email"];
            $password = $_POST["password"];
            $RepeatPassword = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array ();
          
            if (empty($LastName) OR empty($FirstName) OR empty($email) OR empty($password) OR empty($RepeatPassword)){
                array_push($errors, "All fields are required");
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
               
                if(strlen($password)<8){
                    array_push($errors, "Password must be at least 8 characters long");
                   }
                  
                   if($password!= $RepeatPassword){
                    array_push($errors, "Password does not match");
                   }
                   require_once "database.php";
                   $sql = "SELECT * FROM users WHERE email = '$email'";
                   $result = mysqli_query($conn, $sql);
                   $rowCount = mysqli_num_rows($result);
                   if ($rowCount>0) {
                    array_push($erros, "Email Already Exist!");
                   }
                   if (count($errors)>0){
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    require_once "database.php";
                    $sql = "INSERT INTO users(Last_Name, First_Name, email, password)";
                    $stmt = mysqli_stmt_init($conn); 
                  $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                  if ($preparestmt){
                    mysqli_stmt_bind_param($stmt, "ssss", $LastName, $FirstName, $email, $password);
                    mysqli_stmt_execute($stmt);
                    echo "div class = 'alert alert-success'>You are Registered Succesfully! </div>";
                  }else{
                    die("Something went wrong!");
                  }
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