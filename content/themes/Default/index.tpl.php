<!doctype html>
<html>
	<head>
		<title><?php echo $this->encode('title'); ?> &laquo; <?php echo $this->encode('settings[site_title]'); ?></title>
		<?php echo $this->place('css') ?>
  		<?php echo $this->place('rss') ?>
	</head>
	<body>
		<h1><?php echo $this->encode('title'); ?></h1>
		<div id="content">
			<?php echo $this->get('content'); ?>
		</div>
		<?php echo $this->place('js') ?>
	</body>
</html>
