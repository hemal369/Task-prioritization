<?php 
 include 'authenticate.php';
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Add Tags Input Box in HTML CSS & JavaScript</title>
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

	<style>
		*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Poppins', sans-serif;
}

body{
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 90vh;
	background-image: linear-gradient(to right, #2193b0, #6dd5ed);
	/* background-image: linear-gradient(to right, #FFEFBA, #FFFFFF); */
	/* background-image: linear-gradient(to right, #ADA996, #F2F2F2,#DBDBDB,#EAEAEA); */

}

.wrapper{
	width: 500px;
	background: #fff;
	border-radius: 15px;
	padding: 18px 25px 20px;
	box-shadow: 0 0 30px rgba(0,0,0,0.06);
	margin-top: 70px;
}

.wrapper :where(.title, li, li i, .details){
	display: flex;
	align-items: center;
}

.title img{
	max-width: 21px;
}

.title h2{
	font-size: 21px;
	font-weight: 600;
	margin-left: 8px;
}

.wrapper .content{
	margin: 10px 0;
}

.content p{
	font-size: 15px;
}

.content ul{
	display: flex;
	flex-wrap: wrap;
	padding: 7px;
	margin: 12px 0;
	border-radius: 5px;
	border: 1px solid #a6a6a6;
}

.content ul  li{
	color: #333;
	margin: 4px 3px;
	list-style: none;
	border-radius: 5px;
	background: #F2F2F2;
	padding: 5px 8px 5px 10px;
	border: 1px solid #e3e1e1;
}

.content ul li i{
	height: 20px;
	width: 20px;
	color: #808080;
	margin-left: 8px;
	font-size: 12px;
	cursor: pointer;
	border-radius: 50%;
	background: #dfdfdf;
	display: flex;
	justify-content: center;
	align-items: center;
}

.content ul li i:hover {
	background: #929292;
	color: #fff;
}

.content ul input{
	flex: 1;
	padding: 5px;
	border: none;
	outline: none;
	font-size: 16px;
}

.wrapper .details{
	justify-content: space-between;
}	

.details button{
	border: none;
	outline: none;
	color: #fff;
	font-size: 14px;
	cursor: pointer;
	padding: 9px 15px;
	border-radius: 5px;
	background: #2193b0;
	transition: background 0.3s ease;
}

.details button:hover{
	background: #00BCD4;
}
	</style>
</head>

<body>
<?php 

// if(isset($_POST['submit'])){
  
	// $tags_input = $_POST['tags'];
	// $tags_array = explode(',' , $tags_input);

	// foreach ($tags_array as $tag) {
	// 	$escaped_tag = mysqli_real_escape_string($conn, $tag);

	// 	$sql = "insert into tags (title) values ('$escaped_tag') ";
	// 	$iquery = mysqli_query($conn,$sql);

	// 	if($iquery) {
			
	// 		 header('location:../task-add.php');
			 
	// 	}else{
    //       ?>
	// 	    <script>
    //            alert("inserting failed");               
    //         </script> 
	// 	  <?php
	// 	}


	// }

	$tag_array = array();
 
$i = 0;
if(isset($_POST['submit']))
{
//   include_once("dbconnect.php");
//   if($_SERVER["REQUEST_METHOD"]=="POST")
//   {
        while(true)
        {
          if(isset($_POST['tags'][$i]))
          {
            $name = $_POST['tags'][$i];
            // $dept = $_POST['Department'][$i];
            array_push($tag_array,$name);
            // array_push($dept_array,$dept);
            $i++;
          }
          else {
            
            break;
          }
        }
        
        $insertname = implode(",",$tag_array);

		$sql = "insert into tags (title) values ('$insertname') ";
			$iquery = mysqli_query($conn,$sql);
	
			if($iquery) {
				
				//  header('location:../task-add.php');
				echo $insertname;
				 
			}
}


?>  
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="tags-form">

<div class="container" style="display:flex;margin:auto;justify-content:flex-start;align-items:center;">

<div class="row">

	<div class="mb-3" style="text-align:right;">
		<h1>SMART TO-DO</h1>
	</div>

	<div>

		<div class="wrapper">

			<!-- Top Title, Icon Code -->
			<div class="title">
				<i class="fa fa-tags" style="font-size:20px;"></i>
				<h2>Tags</h2>
			</div>

			<!-- Text, Input Code -->
			<div class="content">
				<p>Press enter or add a comma after each tag</p>
				<ul><input type="text" name="tags" spellcheck="false"></ul>
			</div>

			<!-- Text, Remove Button Code -->
			<div class="details">
				<p><span>10</span> tags are remaining</p>
				<button>Remove All</button>
			</div>

		</div>

		<div class="mt-5" style="width:95%;text-align:right;">
		<input type="submit" name="submit" id="register-btn" value="Proceed Further >>"
                                    class="btn btn-primary btn-lg btn-block myBtn" required />	
		</div>
		
	</div> <!-- malksdmlksdklsd -->

</div>

<div class="row">
	<div class="">
		<p>Till what time are you going to work today ?</p>
		<div class="center">

			<div class="form-group">
				<label for="timepicker">Select a time:</label>
				<input type="time" class="form-control mt-2" id="timepicker" placeholder="Select a time">
			</div>

		</div>

	</div>

</div>

</div>

</form>
	

	<!-- <script src="script.js"></script> -->
	<script>
		const ul = document.querySelector("ul"),
input = document.querySelector("input"),
tagNumb = document.querySelector(".details span");

let maxTags = 10,
tags = [];

countTags();
createTag();

function countTags(){
	input.focus();
	tagNumb.innerText = maxTags - tags.length;
}

/* Create Tag Function Code */
function createTag(){
	ul.querySelectorAll("li").forEach(li => li.remove());
	tags.slice().reverse().forEach(tag =>{
		let liTag = `<li name='tags[]' class='tags'>${tag} <i class="fa fa-close" onclick="remove(this, '${tag}')"></i></li>`;
		ul.insertAdjacentHTML("afterbegin", liTag);
	});
	countTags();
}

/* Remove Tag Function Code */
function remove(element, tag){
	let index  = tags.indexOf(tag);
	tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
	element.parentElement.remove();
	countTags();
}

/* Add Tag Function Code */
function addTag(e){
	if(e.key == " "){
		let tag = e.target.value.replace(/\s+/g, ' ');
		if(tag.length > 1 && !tags.includes(tag)){
			if(tags.length < 10){
				tag.split(',').forEach(tag => {
					tags.push(tag);
					createTag();
				});
			}
		}
		e.target.value = "";
	}
}

input.addEventListener("keyup", addTag);

const removeBtn = document.querySelector(".details button");
removeBtn.addEventListener("click", () =>{
	tags.length = 0;
	ul.querySelectorAll("li").forEach(li => li.remove());
	// ul.querySelectorAll("li").setAttribute('name','tags');
	countTags();
});

	</script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"
		integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>