<?php
	session_start();
	require('connect.php');
	if ($_SESSION['username']) {
		include('server2.php'); 

?>

<html>
<head>
	<title>Trang chủ</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<center><h1> Diễn đàn </h1></center>
	<?php include("header.php"); ?>
	<center>
		<a href="post.php"><button>Post topic</button></a><br/><br/>
	<?php 
	if($_GET["id"]){
		$query = "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results)){
			while($row=mysqli_fetch_assoc($results)){
				$view=$row['view'];
				$query_u = "SELECT * FROM users WHERE username='".$row['topic_creator']."'";
				$results_u = mysqli_query($db, $query_u);
				while($row_u=mysqli_fetch_assoc($results_u)){
					$user_idc = $row_u['id'];
					
				}
				echo "<h1>" .$row['topic_name']."</h1>";
				echo "<h5>Bởi <a href='profile.php?id=$user_idc'>".$row['topic_creator']."</a><br/>Ngày ".$row['date']."</h5>";
				echo "<br/>".$row['topic_content'];
				?>
	<div class="topics-wrapper">
   	<div class="topic">
      <div class="topic-info">
	    <!-- if user likes topic, style button differently -->
      	<i <?php if (userLiked($_GET['id'])): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $_GET['id'] ?>"></i>
      	<span class="likes"><?php echo getLikes($_GET['id']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes topic, style button differently -->
      	<i 
      	  <?php if (userDisliked($_GET['id'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $_GET['id'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($_GET['id']); ?></span>
      </div>
   	</div>
  </div>
  <script src="scripts.js"></script>
<?php
			}
		}else {
			echo "Không tồn tại bài viết này";
			
			
		 }
		
		/////////////////////////////////////////////////////
		
		
		
		
		
	}else{
		header("Location: index.php");
	}
	}
	?>
	
	</center>
</body>
</html>

