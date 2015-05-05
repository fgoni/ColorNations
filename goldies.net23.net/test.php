
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
	<title>The Perfect full page Liquid Layout: No CSS hacks. SEO friendly. iPhone compatible.</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="The Perfect full page Liquid Layout (double page): No CSS hacks. SEO friendly. iPhone compatible." />
	<meta name="keywords" content="The Perfect full page Liquid Layout (double page): No CSS hacks. SEO friendly. iPhone compatible." />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link href="css/estilo2.css" rel="stylesheet" type="text/css" />
	<?php 
	include('includes/connect.php');

	?>
	</style>
</head>
<body>

<div id="header">
	<!--<ul>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-3-column.htm">3 Column <span>Holy Grail</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-3-column-blog-style.htm">3 Column <span>Blog Style</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-2-column-left-menu.htm">2 Column <span>Left Menu</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-2-column-right-menu.htm">2 Column <span>Right Menu</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-2-column-double-page.htm">2 Column <span>Double Page</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-full-page.htm" class="active">1 Column <span>Full Page</span></a></li>
		<li><a href="http://matthewjamestaylor.com/blog/perfect-stacked-columns.htm">Stacked <span>columns</span></a></li>
	</ul>-->
		<?php include('includes/cabecera.php'); ?>
</div>
<div class="colmask fullpage">
	<div class="col1">
		<!-- Column 1 start -->
		<?php 	include('includes/login.php'); 
		include('includes/body_info.php'); ?>
		<!-- Column 1 end -->
	</div>
</div>
<div id="footer">
	<?php include('includes/footer.php'); ?>
</div>

</body>
</html>
