<!DOCTYPE html>

<html lang="EN"  xmlns="http://www.w3.org/1999/xhtml"> <!-- utánna nézni -->
	<head>
		<?php include('controlls/config.php'); ?>
		<?php include('views/layout/meta.php'); ?>
		<link rel="canonical" href="<?php echo $self_url; ?>"/>
	</head>
	<body>
		<div class="container-fluid">
		<br>
		kontent
		<br>
			<?php include('views/layout/top.php'); ?>
			<?php include('views/index.php'); ?>
		</div>
		<?php include('views/layout/js.php'); ?>
	</body>
</html>