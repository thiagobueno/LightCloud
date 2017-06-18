<?php $this->layout('layouts::install'); ?>
<p>
<h4>Database's configuration</h4>
<div id="result"></div>

<form id="databaseForm" class="col-sm-12">
    <div class="form-group col-sm-12 col-md-4">
        <label for="host">Host</label>
        <input class="form-control" type="text" name="host" placeholder="Please enter the host of the database" required autofocus>
        <br>
        <label for="charset">Charset</label>
        <input class="form-control" type="text" name="charset" placeholder="Please enter the charset of the database" required>
        <br>
        <label for="port">Port</label>
        <input class="form-control" type="number" name="port" placeholder="Please enter the port of the database" value="3306" required>
        <span id="helpBlock" class="help-block">By default: 3306</span>
    </div>
    <div class="form-group col-sm-12 col-md-8">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" placeholder="Please enter the name of the database" required>
        <br>
        <label for="user">Username (3-16)</label>
        <input class="form-control" type="text" name="user" placeholder="Please enter the username of the database" required>
        <br>
        <label for="password">Password</label>
        <div class="input-group">
            <input id="Passcode" type="password" class="form-control" name="password" placeholder="Please enter the password of the database">
            <div id="PasscodeBtn" class="input-group-addon link"><i id="PasscodeIcon" class="fa fa-eye"></i></div>
        </div>
        <span id="helpBlock" class="help-block">Password can be empty</span>
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

    $(function () {
        $('[data-toggle="popover"]').popover()
    });

    $("#databaseForm").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=APP_URL?>/installation/database",
        type: "POST",
        data: $(this).serialize(),
        success: function(data)
        {
          $("#result").html(data);
        }
      })
    });
</script>
