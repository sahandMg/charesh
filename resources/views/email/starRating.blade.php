<!DOCTYPE html>
<html lang="fa">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="keywords" content="برگزاری مسابقه,مسابقه,برگزاری مسابقه آنلاین,برگزاری مسابقات حضوری,مسبقه ها ورزشی,ورزش, ">
<head>
	<title>Nazar Sanji</title>
	<link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>
<body style="padding: 0px;margin: 0px;width: 100%;">

	<div class="container" style="width: 100%;padding: 0px;">
       <form action="" method="post">
	    <p class="clasificacion">
	       <input id="radio1" type="radio" name="estrellas" value="5"><!--
	      --><label for="radio1">&#9733;</label><!--
	      --><input id="radio2" type="radio" name="estrellas" value="4"><!--
	      --><label for="radio2">&#9733;</label><!--
	      --><input id="radio3" type="radio" name="estrellas" value="3"><!--
	      --><label for="radio3">&#9733;</label><!--
	      --><input id="radio4" type="radio" name="estrellas" value="2"><!--
	      --><label for="radio4">&#9733;</label><!--
	      --><input id="radio5" type="radio" name="estrellas" value="1"><!--
	      --><label for="radio5">&#9733;</label>
		  </p>
		    <p>
		      <input type="submit" value="رای دادن" name="submit" />
		    </p>
	  </form>
     
	</div>
<style type="text/css">
   form {
	  width: 250px;
	  margin: 10px auto;
	  padding: 10px;
	  border: 1px solid #d9d9d9;
	}

	form p,
	form input[type="submit"] {
	  text-align: center;
	  font-size: 20px;
	}

	#wrapper form input[type="submit"] {
	  border: 1px solid #d9d9d9;
	  background-color: #efefef;
	}

	input[type="radio"] {
	  display: none;
	}

	label {
	  color: grey;
	}

	.clasificacion {
	  direction: rtl;
	  unicode-bidi: bidi-override;
	}

	label:hover,
	label:hover ~ label {
	  color: orange;
	}

	input[type="radio"]:checked ~ label {
	  color: orange;
	}
</style>

</body>
</html>