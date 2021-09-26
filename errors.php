<!--A script that displays errors based on errors encountered in server.php-->
<?php if (count($errors) > 0) : ?>
	<div>
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>