<?php $this->layout('layouts::app'); ?>

<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-gears"></i> My Settings</h3>
    </div>
  </div>

  <div class="clearfix"></div>
  <div id="result"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Account settings</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="settingsForm" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required name="name" class="form-control col-md-7 col-xs-12" value="<?=$_SESSION['username']?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" name="email" required class="form-control col-md-7 col-xs-12" value="<?=$_SESSION['email']?>">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button class="btn btn-primary" type="button">Cancel</button>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $("#settingsForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?=APP_URL?>/user/update",
      type: "POST",
      data: $(this).serialize(),
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });
</script>
