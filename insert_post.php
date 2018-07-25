<!doctype html>
<html>
	<head>
		<title>Inserting post</title>
		<style>
			*
			{
				margin:0px;
				padding:0px;
				font-family:"Trebuchet MS";
				box-sizing;border-box;
				
			}
			
			#wrapper
			{
			
			}
			table
			{
				width:60%;
				margin-left:auto;
				margin-right:auto;
				padding:4px;
				margin-top:100px;
				box-shadow:2px 3px 7px #666;
				border-radius:5px 5px 5px 5px;
				position:relative;
				transition:0.3s
			}
			table:hover
			{
				transform:scale(1.1);
			}
			table tr td
			{
				padding:4px;
				
				
			
				
			}
			table tr th
			{
				text-shadow:2px 2px 5px black;
				color:white;
				background-color:#39f;
				font-size:40px;
			}
			table tr td input[type="submit"]
			{
				font-size:15px;
				box-shadow:0xp 2px 5px #666;
				
			}
			
		</style>
	</head>
	
	<body>
		<div id="wrapper">
			<form action="" method="POST" enctype="multipart/form-data">
				<table>
					
					<tr>
						<th colspan="2">Insert Post</th>
					</tr>
					<tr>
						<td>Post Title:</td>
						<td><input type="text" name="title" placeholder="Post Title" autocomplete="off"></td>
					</tr>
					
					<tr>
						<td>Post Author:</td>
						<td><input type="text" name="author" placeholder="Post Author" autocomplete="off"></td>
					</tr>
					
					<tr>
						<td>Choose image:</td>
						<td><input type="file" name="image"></td>
					</tr>
					
					
					<tr>
						<td>Post Content:</td>
						<td><textarea name="content"></textarea></td>
					</tr>
					
					<tr>
						
						<td><input type="submit" name="Publish" value="Publish"></td>
					</tr>
					
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>

<?php
	if(isset($_POST['Publish']))
	{
		 $title=$_POST['title'];
		 $author=$_POST['author'];
		 $date=date("y-m-d");
		 $image_name=$_FILES['image']['name'];
		 $image_size=$_FILES['image']['size'];
		 $image_type=$_FILES['image']['type'];
		 $image_tmp=$_FILES['image']['tmp_name'];
		 $content=$_POST['content'];
		 
		 if($title=="" OR $author=="" OR $content=="")
		 {
			 echo "<script>alert('Please! fill Out the Form Completely')</script>";
		 }
		 
				 if($image_type=="image/jpeg" OR $image_type=="image/png" OR $image_type=="image/gif")
				 {
					 if($image_size<=5000000)
					 {
						 move_uploaded_file($image_tmp,"images/$image_name");
						 
						 
					 }
					 else
					 {
						 echo "<script>alert('image size should be less than 5MB')</script>";
					 }
					 
					 
				 }
				 else
				 {
					 echo "<script>alert('image type is invalid')</script>";
				 }
				
				
				
				
			$con=@mysql_connect("localhost","root","")or die("sorry the connection couldnot be established");
			$db=@mysql_select_db("airline",$con)or die("sorry the database couldnot be selected");

			$query="insert into plane(post_title,post_date,post_author,post_image,post_content)values('$title','$date','$author','$image_name','$content')";
			$result=mysql_query($query);
			if($result==1)
			{
				echo "<script>alert('post has been published')</script>";
			}

			
	}
?>