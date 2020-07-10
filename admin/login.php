<?php
include("db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = $_POST['inputEmail'];
	$password = $_POST['inputPassword'];
	echo $username;
	echo "\n".$password;

	$sql = "SELECT `password` FROM adminlogin WHERE `adminlogin`.`userID` = :username";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$pass = $stmt->fetchObject()->password;

	if ($pass == $password) {
		$_SESSION['adminID'] = $username;
		header("location:home.php");
	} else {
		echo "\nFailed login";
	}
	$conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/node_modules/shards-ui/dist/css/shards.min.css"
    />
    <script
      src="https://kit.fontawesome.com/97f3c2998d.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./assets/css/login.css" />

    <!--Validation-->
    <script type="text/javascript">
      (function () {
        "use strict";
        window.addEventListener(
          "load",
          function () {
            var form = document.getElementById("needs-validation");
            form.addEventListener(
              "submit",
              function (event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add("was-validated");
              },
              false
            );
          },
          false
        );
      })();
    </script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
          <div class="login d-flex align-items-center py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                  <h3 class="login-heading mb-4">Library Management System</h3>
                  <form id="needs-validation" action="" method="POST" novalidate>
                    <div class="form-label-group">
                      <input
                        type=""
						id="inputEmail"
						name="inputEmail"
                        class="form-control"
                        placeholder="Email address"
                        aria-describedby="inputGroupPrepend"
                        required
                        required
                        autofocus
                      />
                      <label for="inputEmail">Email address</label>
                      <div class="invalid-feedback">
                        Please provide a valid email.
                      </div>
                    </div>

                    <div class="form-label-group">
                      <input
                        type="password"
                        id="inputPassword"
                        name="inputPassword"
                        name="inputPassword"
                        class="form-control"
                        placeholder="Password"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        required
                      />
                      <label for="inputPassword">Password</label>
                      <div class="invalid-feedback">
                        Must contain at least one number and one uppercase and
                        lowercase letter, and at least 8 or more characters
                      </div>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                      <input
                        type="checkbox"
                        class="custom-control-input"
                        id="customCheck1"
                      />
                      <label class="custom-control-label" for="customCheck1"
                        >Remember password</label
                      >
                    </div>
                    <button
                      class="btn btn-lg btn-info btn-block text-uppercase font-weight-bold mb-2"
                      type="submit"
                    >
                      Sign in
                    </button>
                    <div class="text-center">
                      <a class="small" href="#">Forgot password?</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./assets/node_modules/popper.js/dist/popper.min.js"></script>
    <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
  </body>
</html>
