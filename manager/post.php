<?php
	// Prerequisites
	include_once($_SERVER["DOCUMENT_ROOT"] . '/examples/manager/inc/application_top.php');
		
	// Create the Post Class
	$myPost = new Post;
	$myTag = new Tag;
	$myCategory = new Category;
	
	// If they are saving the Information
	if ($_POST['submit_button'] == 'Salvar borrador y continuar editando' || $_POST['submit_button'] == 'Salvar' || $_POST['submit_button'] == 'Salvar y publicar'){
		$redirect = true;
		
		// Get all the Form Data
		$myPost->SetValues($_POST);
		
		switch($_POST['submit_button']){
			case 'Salvar borrador y continuar editando':
				$myPost->SetValue('status', 'Draft');
				$redirect = false;
				break;
			case 'Salvar y publicar':
				$myPost->SetValue('status', 'Published');
			default:
				break;
		}
		
		// Save the info to the DB if there is no errors
		if ($myPost->Save()){
			// Sync in the Tags
			$myPostTag = new PostTag;
			$myPostTag->SetValue('post_id', $myPost->GetPrimary());
			$myPostTag->Sync($myPost->GetValue('tags'));
		
			SetAlert('Post Information Saved.','success');
			
			// Redirect if needed
			if ($redirect){
				header('location:posts.php');
				die();
			}	
		}
	}
	
	// If Deleting the Page
	if ($_POST['submit_button'] == 'Eliminar'){
		// Get all the form data
		$myPost->SetValues($_POST);
		
		// Remove the info from the DB
		if ($myPost->Delete()){
			// Set status and redirect
			SetAlert('Post Deleted Successfully','success');
			header('location:posts.php');
			die();
		}else{
			SetAlert('Error Deleting Post, Please Try Again');
		}
	}
	
	// Set the requested primary key and get its info
	if ($_GET['id'] != '' && $myPost->GetPrimary() == ''){
		// Set the primary key
		$myPost->SetPrimary((int)$_GET['id']);
		
		// Try to get its information
		if (!$myPost->GetInfo()){
			SetAlert('Invalid Post, please try again');
			$myPost->ResetValues();
		}
	}
	
	// Display the Header
	define('PAGE_TITLE',(($myPost->GetPrimary() != '')?'Edit':'Add') . ' Post');
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
		<a href="posts.php" ><button class="btn btn-primary" type="button">Volver a la lista</button></a>
		<?php echo ($myPost->GetPrimary() != '')?'<a href="post.php"><button class="btn btn-primary" type="button">A&ntilde;adir nueva entrada</button></a>':'';?>
	</div>
	
	<form action="post.php<?php echo ($myPost->GetPrimary() != '')?'?id=' . $myPost->GetPrimary():''; ?>" method="post" name="edit_post">
		<?php $myPost->Form(); ?>
		<fieldset class="submit_button">
			<label for="submit_button">&nbsp;</label><input class="btn btn-inverse" name="submit_button" type="submit" value="Salvar borrador y continuar editando" class="submit" />
			<input class="btn" name="submit_button" type="submit" value="Salvar" class="submit" />
			<input class="btn btn-success" name="submit_button" type="submit" value="Salvar y publicar" class="submit" />
			<?php echo ($myPost->GetPrimary() != '')?' <input class="btn btn-danger" name="submit_button" type="submit" value="Eliminar" class="submit" />':''; ?>
		</fieldset>
	</form>
</div>
<?php 
	// Footer
	include_once('inc/footer.php');
?>