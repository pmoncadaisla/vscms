<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
	
	// Create the Post Class
	$myPost = new Post;
	
	// Setup the Display
	$display[] = array('title', 'date_entered', 'author_id', 'status');
	$locations = array('title' => '<a href="post.php?id={$item_id}">{$data}</a>');
	$options = array('date_entered' => 'DateTimeDiff');
	
	// Create the Author Class
	$myAuthor = new Author;
	$myPost->Join($myAuthor,'author_id','LEFT');
	$display[] = array('first_name','last_name');
	
	// Reformat the display for the list
	$display_list = array('title', 'first_name', 'last_name', 'date_entered', 'status');
	
	// Figure out the display type and order, Taken from DisplayList(), Need to find a better way to do this, it does not work with joined orders
	$_SESSION[$myPost->table . '_sort'] = ($_GET['sort'] != '')?$_GET['sort']:$_SESSION[$myPost->table . '_sort'];
	$_SESSION[$myPost->table . '_order'] = ($_GET['order'] != '')?$_GET['order']:$_SESSION[$myPost->table . '_order'];
	
	// Add some Filtering
	if (trim($_GET['q']) != ''){
		$myPost->Search(trim($_GET['q']), array('title','body'), $display);
	}else{
		// Get the full list
		$myPost->GetList($display, $_SESSION[$myPost->table . '_sort'], $_SESSION[$myPost->table . '_order']);
	}
	
	// If exporting
	if (isset($_GET['export']))
		$myPost->Export('csv', $display_list, 'posts','download');
	
	// Header
	define('PAGE_TITLE','Edit Posts');
	include_once('inc/header.php');
?>
<div id="main-info">
	<h1>Blog Posts</h1>
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
		<a href="post.php" ><button class="btn btn-success" type="button">A&ntilde;adir nueva entrada</button></a>
	</div>
	<?php
		// Display the List
		$myPost->DisplayList($display_list, $locations, $options, false);
	?>
</div>
<?php
	// Footer
	include_once('inc/footer.php');
?>
