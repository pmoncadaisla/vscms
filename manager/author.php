<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
	
	// Create the Author Class
	$myAuthor = new Author;
	
	// If they are saving the Information
	if ($_POST['submit_button'] == 'Guardar'){
		// Get all the Form Data
		$myAuthor->SetValues($_POST);
		
		// Save the info to the DB if there is no errors
		if ($myAuthor->Save())
			SetAlert('Author Information Saved.','success');
	}
	
	// If Deleting the Page
	if ($_POST['submit_button'] == 'Eliminar'){
		// Get all the form data
		$myAuthor->SetValues($_POST);
		
		// Remove the info from the DB
		if ($myAuthor->Delete()){
			// Set alert and redirect
			SetAlert('Author Deleted Successfully','success');
			header('location:authors.php');
			die();
		}else{
			SetAlert('Error Deleting Author, Please Try Again');
		}
	}
	
	// Set the requested primary key and get its info
	if ($_GET['id'] != ''){
		// Set the priarmy key
		$myAuthor->SetPrimary((int)$_GET['id']);
		
		// Try to get the information
		if (!$myAuthor->GetInfo()){
			SetAlert('Invalid Author, please try again');
			$myAuthor->ResetValues();
		}
	}
	
	// Display the Header
	define('PAGE_TITLE',(($myAuthor->GetPrimary() != '')?'Edit':'Add') . ' Author');
	include_once('inc/header.php');
?>
<div id="main-info">
	<h1><?php echo PAGE_TITLE; ?></h1>
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
		<a href="authors.php" ><button class="btn btn-primary" type="button">Volver a la lista</button></a>
		<?php echo ($myAuthor->GetPrimary() != '')?'<a href="author.php"><button class="btn btn-primary" type="button">A&ntilde;adir nuevo autor</button></a>':'';?>
	</div>
	
	<form action="author.php<?php echo ($myAuthor->GetPrimary() != '')?'?id=' . $myAuthor->GetPrimary():''; ?>" method="post" name="edit_author">
		<?php $myAuthor->Form(); ?>
		<fieldset class="submit_button">
			<label for="submit_button">&nbsp;</label><input class="btn btn-success" name="submit_button" type="submit" value="Guardar" class="submit" />
			<?php echo ($myAuthor->GetPrimary() != '')?' <input name="submit_button" class="btn btn-danger" type="submit" value="Eliminar" class="submit" />':''; ?>
		</fieldset>
	</form>
</div>
<?php 
	// Footer
	include_once('inc/footer.php');
?>
