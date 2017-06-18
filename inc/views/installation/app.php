<?php $this->layout('layouts::install'); ?>

<p>
<h4>Application's configuration</h4>

<div id="result"></div>

<form id="appForm" class="col-sm-12">
    <div class="form-group col-sm-12 col-md-12">
        <label for="exampleInputEmail1">URL</label>
        <input class="form-control" type="text" name="url" value="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]"?>"  placeholder="Please enter the app URL" required>
        <br>
        <label for="exampleInputEmail1">Name</label>
        <input class="form-control" type="text" name="name" placeholder="Please enter the app name" required>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-primary pull-right">Next <i class="fa fa-arrow-right"></i></button>
    </div>
</form>
</p>

<script type="text/javascript">
    $("#appForm").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=APP_URL?>/installation/config",
        type: "POST",
        data: $(this).serialize(),
        success: function(data)
        {
          $("#result").html(data);
        }
      })
    });
</script>
