<?php $this->layout('layouts::app'); ?>

<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-gears"></i> Settings</h3>
    </div>
  </div>

  <div class="clearfix"></div>
  <div id="result"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Application settings</h2>
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
          <form id="appForm" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Application name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required name="name" class="form-control col-md-7 col-xs-12" value="<?=APP_NAME?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Application url</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="url" name="url" required class="form-control col-md-7 col-xs-12" value="<?=APP_URL?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Application version</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" value="<?=APP_VERSION?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Application salt 1</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="text" readonly  value="<?=SALT_1?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Application salt 2</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="text" readonly  value="<?=SALT_2?>">
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

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-database"></i> Database settings</h2>
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
          <form id="databaseForm" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Database host</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required name="host" class="form-control col-md-7 col-xs-12" value="<?=DB_HOST?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Database name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="name" required class="form-control col-md-7 col-xs-12" value="<?=DB_NAME?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Database charset</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" name="charset" value="<?=DB_CHARSET?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Database port</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="int" name="port" value="<?=DB_PORT?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Database username</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="text" name="user" value="<?=DB_USER?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Database password</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="password" name="password">
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
  $("#appForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?=APP_URL?>/admin/app/update",
      type: "POST",
      data: $(this).serialize(),
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });

  $("#databaseForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: "<?=APP_URL?>/admin/database/update",
      type: "POST",
      data: $(this).serialize(),
      success: function(data)
      {
        $("#result").html(data);
      }
    });
  });
</script>
