<!DOCTYPE html>
<html lang="en">

<head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/node_modules/shards-ui/dist/css/shards.min.css" />
    <link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/login.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image mt-4"></div>
            <div class="col-md-8 col-lg-6 bg-blue">
                <div class="login d-flex align-items-center pb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <div class="text-center pb-4">
                                    <h4 class="text-white mb-4 text-capitalize font-weight-light">
                                        Welcome to
                                    </h4>
                                    <h1 class="text-white mb-4 font-weight-bold">
                                        AlphaByte
                                    </h1>
                                    <h5 class="text-white mb-4 font-weight-light">
                                        Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit.
                                        Cupiditate aliquid,
                                    </h5>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="User ID" aria-describedby="inputGroupPrepend" required autofocus />
                                    <label for="inputEmail">User ID</label>
                                    <div class="invalid-feedback">
                                        Please provide a valid user ID.
                                    </div>
                                </div>
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" name="inputPassword" name="inputPassword" class="form-control" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                                    <label for="inputPassword">Password</label>
                                    <div class="invalid-feedback">
                                        Must contain at least one number
                                        and one uppercase and lowercase
                                        letter, and at least 8 or more
                                        characters
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-orange btn-block text-uppercase font-weight-bold mb-2" type="button" id="loginButton">
                                    Sign in
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/node_modules/shards-ui/dist/js/shards.min.js"></script>
    <script src="login/login.js"></script>
</body>

</html>