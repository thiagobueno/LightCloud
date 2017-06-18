<?php $this->layout('layouts::install'); ?>


<div id="result"></div>
<h4>Creating the Administrator Account</h4>
<p>
<form id="registerForm" class="col-sm-12">
    <div class="form-group col-sm-12 col-md-12">
        <label for="username">Username (3-16)</label>
        <input class="form-control" type="text" name="username" placeholder="Please enter your username" required>
        <br>
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="Please enter your email" required>
        <br>
        <label for="password">Mot de passe</label>
        <div class="input-group">
            <input id="Passcode" type="password" class="form-control" name="password" placeholder="Please enter your password" required>
            <div id="PasscodeBtn" class="input-group-addon link"><i id="PasscodeIcon" class="fa fa-eye"></i></div>
        </div>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-primary pull-right">Next <i class="fa fa-arrow-right"></i></button>
    </div>
</form>
</p>

<script type="text/javascript">
    $("#PasscodeBtn").click(function() {

        if($("#PasscodeIcon").hasClass("fa-eye")){ //showed

            $("#PasscodeIcon").removeClass("fa-eye");
            $("#PasscodeIcon").addClass("fa-eye-slash");
            $("#Passcode").attr("type", "text");
        }else{

            $("#PasscodeIcon").removeClass("fa-eye-slash"); //hidden
            $("#PasscodeIcon").addClass("fa-eye");
            $("#Passcode").attr("type", "password");
        }

    });

    $("#registerForm").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=APP_URL?>/installation/user",
        type: "POST",
        data: $(this).serialize(),
        success: function(data)
        {
          $("#result").html(data);
        }
      });
    });
</script>
