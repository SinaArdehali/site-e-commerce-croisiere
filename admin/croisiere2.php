<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/CPTBrouillon/core/init.php';
if(!is_logged_in()){
		login_error_redirect();
}

include 'includes/head.php';
include 'includes/navigation.php';



$reqListePart ="SELECT *
FROM partenaire
group by nomPartenaire
order by nomPartenaire
";
$resListePart = $db->query($reqListePart);


$sizesArray = array();
if ($_POST){
	$title = sanitize($POST['title']);
	$brand = sanitize($POST['brand']);
	$categories = sanitize($POST['child']);
	$price = sanitize($_POST['price']);
	$list_price = sanitize($_POST['list_price']);
	$sizes = sanitize($_POST['sizes']);
	$description = sanitize($_POST['description']);
	$dbpath ='';
	$errors = array();
	if(!empty($_POST['sizes'])){
		$sizeString = sanitize($_POST['sizes']);
		$sizeString = rtrim($sizeString, ',');
		$sizesArray = explode(',',$sizeString);
		$sArray = array();
		$qArray = array();
		foreach ($sizesArray as $ss) {
			$s = explode(':',$ss);
			$sArray[] = $s[0];
			$qArray[] = $s[1];

		}
	}else{$sizesArray =array();}
	$required = array('nom', 'partenaire', 'dateDebut', 'dateFin', 'nbCategorie');
	foreach ($required as $field) {
		if ($_POST[$field] == ''){
			$errors[] = 'All fields with an asterisk are required.';
			break;
		}
	}
	if(!empty($_FILES)){
		var_dump($_FILES);
		$photo = $_FILES['photo'];
		$name = $photo['name'];
		$nameArray = explode('.', $name);
		$fileName = $nameArray[0];
		$fileExt = $nameArray[1];
		$mime = explode('/', $photo['type']);
		$mimeType = $mime[0];
		$mimeExt = $mime[1];
		$tmpLoc = $photo['tmp_name'];
		$fileSize = $photo['size'];
		$allowed = array('png', 'jpg', 'jpeg', 'gif');
		$uploadName = md5(microtime()).'.'.$fileExt;
		$uploadPath = BASEURL.'images/products'.$uploadName;
		$dbpath = '/CPTBrouillon/images/products'.$uploadName;
		if($mimeType != 'image'){
			$errors[] = 'The file must be an image';
		}
		if(!in_array($fileExt, $allowed)){
			$errors[] = 'The photo extension must be png jpg jpeg or gif';
		}
		if($fileSize > 1000000){
			$errors[] = 'The files size must be under 15 mb';
		}
		if ($fileExt != $mimeExt && ($mimeType == 'jpeg' && $fileExt != 'jpg')){
			$errors[] ='File extension does not match the file';
		}
	}
	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		//upload file and insert into database
		move_uploaded_file($tmpLoc,$uploadPath);
		$insertSql = "insert into products ('title','price','list_price','brand','categories','sizes','images', 'description') values ('$title','$price','$list_price','$brand','$categories','$sizes','$images', 'dbpath', '$description')";
		$db -> query($insertSql);
		header('Location: products.php');
	}

}



?>


<h2 class=text-center>Ajouter une croisiere</h2></br>
<form action="products.php?add=l" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>

		<div class="form-group col-md-3">
			<label for="parent">Quel partenaire vous fournit cette croisiere:</label>
			<select class="form-control" name="partenaire" id="partenaire">
				<option value="0">Partenaire</option>
				<?php while ($tabListePart =mysqli_fetch_assoc($resListePart)) : ?>
					<option value="<?=$tabListePart['idPartenaire'];?>"><?=$tabListePart['nomPartenaire'];?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Date de Début:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Date de Fin:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-3">
			<label for="nom">Nombre de Categorie:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>

		<div class="form-group col-md-3">
			<label for="parent">Quel partenaire vous fournit cette croisiere:</label>
			<select class="form-control" name="partenaire" id="partenaire">
				<option value="0">Partenaire</option>
				<?php while ($tabListePart =mysqli_fetch_assoc($resListePart)) : ?>
					<option value="<?=$tabListePart['idPartenaire'];?>"><?=$tabListePart['nomPartenaire'];?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>

		<div class="form-group col-md-3">
			<label for="parent">Quel partenaire vous fournit cette croisiere:</label>
			<select class="form-control" name="partenaire" id="partenaire">
				<option value="0">Partenaire</option>
				<?php while ($tabListePart =mysqli_fetch_assoc($resListePart)) : ?>
					<option value="<?=$tabListePart['idPartenaire'];?>"><?=$tabListePart['nomPartenaire'];?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
		<div class="form-group col-md-3">
			<label for="nom">Nom:</label>
			<input type="text" name="nom" class="form-control" id="title" value="<?=((isset($_POST['nom']))?sanitize($_POST['nom']):'');?>">
		</div>
	</div>


		<div class="form-group col-md-3">
			<label>Quantity & sizes:</label>
			<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">quantity & sizes</button>
		</div>
		<div class="form-group col-md-3">
			<label for="sizes">sizes & qty preview:</label>
			<input type="text" name="sizes" class="form-control" id="sizes" value="<?=((isset($_POST['sizes']))?sanitize($_POST['sizes']):'');?>" readonly>
		</div>

		<div class="form-group col-md-6">
			<label for="photo">photo</label>
			<input type="file" name="photo" class="form-control" id="photo">
		</div>

		<div class="form-group col-md-6">
			<label for="description">description</label>
			<textarea id="description" name="description" class="form-control" rows="6"><?=((isset($_POST['description']))?sanitize($_POST['description']):'');?></textarea>
		</div>

		
		<div class="form-group pull-right">
		<input type="submit" value="Add Product" class="form-control btn btn-success">
		</div><div class="clearfix"></div>

</form>

<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">size and quantity</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <?php for($i=1;$i <= 12;$i++): ?>
        	<div  class="form-group col-md-4">
        		<label for="size<?=$i;?>">sizes:</label>
        		<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
        	</div>
        	<div  class="form-group col-md-2">
        		<label for="qty<?=$i;?>">quantity:</label>
        		<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
        	</div>
    	<?php endfor; ?>
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>




<?php  include 'includes/footer.php';