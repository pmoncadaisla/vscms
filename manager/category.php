<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
	
	// Create the Category Class
	$myCategory = new Category;
	
	// If they are saving the Information
	if ($_POST['submit_button'] == 'Guardar'){
		// Get all the Form Data
		$myCategory->SetValues($_POST);
		
		// Save the info to the DB if there is no errors
		if ($myCategory->Save())
			SetAlert('Category Information Saved.','success');
	}
	
	// If Deleting the Page
	if ($_POST['submit_button'] == 'Eliminar'){
		// Get all the form data
		$myCategory->SetValues($_POST);
		
		// Remove the info from the DB
		if ($myCategory->Delete()){
			// Set alert and redirect
			SetAlert('Category Deleted Successfully','success');
			header('location:categories.php');
			die();
		}else{
			SetAlert('Error Deleting Category, Please Try Again');
		}
	}
	
	// Set the requested primary key and get its info
	if ($_GET['id'] != ''){
		// Set the priarmy key
		$myCategory->SetPrimary((int)$_GET['id']);
		
		// Try to get the information
		if (!$myCategory->GetInfo()){
			SetAlert('Invalid Category, please try again');
			$myCategory->ResetValues();
		}
	}
	
	// Display the Header
	define('PAGE_TITLE',(($myCategory->GetPrimary() != '')?'Edit':'Add') . ' Category');
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
		<a href="categories.php" ><button class="btn btn-primary" type="button">Volver a la lista</button></a>
		<?php echo ($myCategory->GetPrimary() != '')?'<a href="category.php"><button class="btn btn-primary" type="button">A&ntilde;adir nueva categor&iacute;a</button></a>':'';?>
	</div>
	
	<form action="category.php<?php echo ($myCategory->GetPrimary() != '')?'?id=' . $myCategory->GetPrimary():''; ?>" method="post" name="edit_Category">
		<?php $myCategory->Form(); ?>
		<fieldset class="submit_button">
			<label for="submit_button">&nbsp;</label><input class="btn btn-success" name="submit_button" type="submit" value="Guardar" class="submit" />
			<?php echo ($myCategory->GetPrimary() != '')?' <input name="submit_button" class="btn btn-danger" type="submit" value="Eliminar" class="submit" />':''; ?>
		</fieldset>
	</form>
</div>
<?php 
	// Footer
	include_once('inc/footer.php');
?>
