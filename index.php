<?php 

	// Compress image
	function compressImage($source, $destination, $quality) {

	  $info = getimagesize($source);

	  if ($info['mime'] == 'image/jpeg') 
	    $image = imagecreatefromjpeg($source);

	  elseif ($info['mime'] == 'image/gif') 
	    $image = imagecreatefromgif($source);

	  elseif ($info['mime'] == 'image/png') 
	    $image = imagecreatefrompng($source);

	  imagejpeg($image, $destination, $quality);

	}

	
	if(isset($_POST['upload'])){

	  // Getting file name
	  $filename = $_FILES['imagefile']['name'];
	 
	  // Valid extension
	  $valid_ext = array('png','jpeg','jpg');

	  // Location
	  $location = "images/".$filename;

	  // file extension
	  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
	  $file_extension = strtolower($file_extension);

	  // Check extension
	  if(in_array($file_extension,$valid_ext)){

	    // Compress Image
	    compressImage($_FILES['imagefile']['tmp_name'],$location,40);

	  }else{
	    echo "Invalid file type.";
	  }
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Image Compressor</title>
 </head>
 <body>

 	<h1>Image Compressor</h1>

 	<div style="border: 1px solid red ; padding: 50px;">

 		<?php 

 			if (isset($location))
			{
				echo '<img src="'.$location.'" style=" width:300px; height:auto; ">';
			}
 		 ?>
 		
 		<form method='post' enctype='multipart/form-data'>
 		  <input type='file' name='imagefile' style="margin-bottom: 10px;">

 		  <br/>

 		  <input type='submit' value='Upload' name='upload'> 
 		</form>

 	</div>


 
 </body>
 </html>