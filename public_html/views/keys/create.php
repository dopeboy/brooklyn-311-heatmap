
<?php if ($this->state == 0) { ?>
<legend>Create API key</legend>
<p>Fill out the below to get an API key.</p>
<br/>
<form class="form-horizontal form-submit" action="/keys/create/null/1" method="post">
  <div class="form-group">
    <div class="col-sm-4">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-default">Create</button>
    </div>
  </div>
</form>

<?php } else if ($this->state == 2) { ?>
<legend>Sweeeeeeeet</legend>
<img src="https://cloud.githubusercontent.com/assets/222958/5265084/d592d2fa-7a37-11e4-9501-9429aa30f6f2.gif"/>
<img src="https://cloud.githubusercontent.com/assets/194377/5263503/19704dbe-7a32-11e4-8c93-8c2ef8e9af64.gif"/>

<br/><br/><br/>
<p>Here's your key: <?php echo $this->id;?></p>
Copy and paste this somewhere; you will need it later.
<?php } ?>
