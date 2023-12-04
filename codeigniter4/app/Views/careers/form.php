<section>

	<h3><?php echo $actionTitle ?> </h3>
	<form action="<?= site_url('careers/save'); ?>" method="POST" class="form-inline" role="form">
    <input type="hidden" class="form-control" name="id" value="<?php echo isset($career) ? $career['id'] : '' ?>">
    <div class="form-group">
      <label class="sr-only" for="name">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Career Name" value="<?php echo isset($career) ? $career['name'] : '' ?>">
    </div>
    <input type="submit" class="btn btn-primary" value="Save"></input>
  </form>
  
</section>
