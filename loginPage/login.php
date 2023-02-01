<?php 
// =============================
if(isset($_POST['login'])) // When click the button 
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password))
		{

			// Backend for API
            $url = ""; // Type your API link here

            // Sending request through the following configuration...
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Determine request type and other properties
            $headers = array(
            "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // Assign headers info with the request

            // The data that will be posted with the request
            $data = <<<DATA
            {
                "username": "$username",
                "password": "$password"
            }
            DATA;

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            // For debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl); // Execute our request (POST API)
            curl_close($curl); // Close the connection
            var_dump($resp); // Identify the result as variable

            echo $resp; // Print out the result
            
            $user_data = json_decode($resp); // Decoding the result into $user_data variable

            print_r($user_data->responseCode); // Show the value of responseCode from API

            $resCode = $user_data->responseCode; // Get responseCode value inside $resCode variable

            if($resCode == 2) { // IF the responseCode is 2 then go to home page (Successful process)
                echo "<script>window.open('home.html', '_self')</script>";
            }

			$error = array(); // Array to store any error any print it later
			$error[] ='<div class="alert alert-danger alert-dismissible input-sm" role="alert" 
			dir="rtl" style="font-size: 15px; padding-top: 5px; padding-right: -5px; padding-bottom: 0px; padding-left: 0px">

			</button>
			<strong style="color: #e62e00;">تنبيه !</strong> البريد الالكتروني او كلمة المرور خاطئة
			</div>';
			

		} else {
			$error[]= '<div class="alert alert-danger alert-dismissible input-sm" role="alert" 
			dir="rtl" style="font-size: 15px; padding-top: 5px; padding-right: -5px; padding-bottom: 0px; padding-left: 0px">

			</button>
			<strong style="color: #e62e00;">تنبيه !</strong> البريد الالكتروني او كلمة المرور خاطئة
			</div>';
			
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <img src="img/bg.png" alt="" class="wave">
    <div class="container">
        <div class="img">
            <img src="img/img-3.svg" alt="">
        </div>
        <div class="login-box">
            <form action="login.php" method="post">
                <img src="img/avatar.svg" alt="" class="avatar">
                <h2>Welcome</h2>
                <!-- ====== print the error =====-->
						<?php
						if(!empty($error)) {
								foreach ($error as $err){
								echo $err;
									}
								}
						?>
                <div class="input-group">
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input type="text" class="input" name="username">
                    </div>
                </div>
                <div class="input-group">
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" class="input" name="password">
                    </div>
                </div>
                <input type="submit" class="btn" name="login" value="login">
            </form>
        </div>
    </div>
    <a href="https://twitter.com/mokh08" target="_blank" class="copyright">&copy; Mohammed Almalki</a>
    <script src="js/app.js" type="text/javascript"></script>
</body>
</html>