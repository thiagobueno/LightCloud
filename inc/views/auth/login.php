<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An another opensource cloud system.">
    <meta name="author" content="Roch Blondiaux">

    <title><?=APP_NAME?></title>

    <!-- Bootstrap -->
    <link href="<?=APP_URL?>/inc/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=APP_URL?>/inc/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=APP_URL?>/inc/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=APP_URL?>/inc/assets/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="<?=APP_URL?>/inc/assets/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Custom Theme Style -->
    <link href="<?=APP_URL?>/inc/assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="loginForm">
              <h1>Login Form</h1>
              <div id="loginResult"></div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" autofocus />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New here ?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-lightbulb-o fa-lg fa-fw"></i> LightCloud</h1>
                  <p>LightCloud 2017 © All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="registerForm">
              <h1>Create Account</h1>
              <div id="registerResult"></div>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required=""/>
              </div>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Register</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-lightbulb-o fa-lg fa-fw"></i> LightCloud</h1>
                  <p>LightCloud 2017 © All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <!-- Ajax scripts -->
    <script>
      $("#loginForm").on("submit", function(e){
        e.preventDefault();
        $.ajax({
          url: "<?=APP_URL?>/login",
          type: "POST",
          data: $(this).serialize(),
          success: function(data){
            $("#loginResult").html(data);
          }
        });
      });

      $("#registerForm").on("submit", function(e){
        e.preventDefault();
        $.ajax({
          url: "<?=APP_URL?>/register",
          type: "POST",
          data: $(this).serialize(),
          success: function(data){
            $("#registerResult").html(data);
          }
        });
      });
    </script>
  </body>
</html>
