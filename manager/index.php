<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
	
	// Grab some Information about the Blog
	$myAuthor = new Author;
	$authors = $myAuthor->GetList('count');
	
	$myPost = new Post;
	$posts = $myPost->GetList('count');
	
	$myCategory = new Category;
	$categories = $myCategory->GetList('count');
			
	// Header
	define('PAGE_TITLE','Welcome');
	include_once('inc/header.php');
?>
<div id="main-info">
	<h1>Blog Manager</h1>
</div>
<div id="data">
	<h2>Estad&iacute;sticas</h2>
	<ul>
		<li>Autores: <?php echo $authors['count']; ?></li>
		<li>Entradas: <?php echo $posts['count']; ?></li>
		<li>Categor&iacute;as: <?php echo $categories['count']; ?></li>
	</ul>
</div>
<?php include_once('inc/footer.php'); ?>