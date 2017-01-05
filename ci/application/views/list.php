<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>

		<style>
            div{
				display:block;
				margin-left: 50px;
				margin-top: 15px;
            }
            a:link{ color: blue;    }
			a:visited{color: blue;  }
        </style>
	</head>
	<body>

		<div id="container">
			<?php
				foreach($list as $r){
					$ex = htmlentities($r['title']);
					echo "<div>- <a target=\"_blank\" href='{$r['url']}' >{$ex}</a><br/></div>";
				} 	
			?>
			
		</div>

	</body>
</html>