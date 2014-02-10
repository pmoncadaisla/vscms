<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
	
	// Create the Author Class
	$myAuthor = new Author;
	
	// Setup the Display
	$display = array('first_name', 'last_name', 'email', 'date_entered');
	$locations = array('first_name' => '<a href="author.php?id={$item_id}">{$data}</a>');
	$options = array();
	
	// Add some Filtering
	if (trim($_GET['q']) != '')
		$myAuthor->search = trim($_GET['q']);
	
	// Header
	define('PAGE_TITLE','Edit Authors');
	include_once('inc/header.php');
?>
<div id="main-info">
	<h1>Autores</h1>
	<form class="form-search" action="<?php echo htmlspecialchars(sprintf("%s%s%s","http://",$_SERVER["HTTP_HOST"],$_SERVER["REQUEST_URI"])); ?>" method="get" name="search" id="search">
		<fieldset>
			<legend>Buscar</legend>
			<div><label>Buscar:</label><input name="q" type="text" class="input-medium search-query" value="<?php echo stripslashes($_GET['q']); ?>" /> <input name="submit" type="submit" value="Buscar" class="btn" /></div>
		</fieldset>
	</form>
</div>
<div id="data">
	<div id="notifications">
	<?php
		// Report errors to the user
		Alert(GetAlert('error'));
		Alert(GetAlert('success'),'success');
	?>
	</div>
	
	<div class="options">
		<a href="author.php" title="A New Blog Category"><button class="btn btn-success" type="button">A&ntilde;adir nuevo autor</button></a>
	</div>
	<?php
		// Display the List
		$myAuthor->DisplayList($display, $locations, $options);
	?>
</div>	
<?php
	// Footer
	include_once('inc/footer.php');
?>