<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Quotes</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    $alias = $this->session->userdata('alias');
    $active_id = $this->session->userdata('active_id');
   ?>

   <div class="row">
     <div class="col s12">
       <a href="/dashboard">Dashboard</a> | <a href="/logout">Logout</a>
     </div>
   </div>
   <div class="row">
     <div class="col s12">
       <h4>Create a New Wish List Item</h4>
       <form class="" action="/wishlist/add_form" method="post">
         <label for="description">Item/Product</label>
         <input type="text" name="description" value="">
         <input type="hidden" name="active_id" value="<?php echo $active_id ?>">
         <input type="submit" value="Add">

       </form>
     </div>
   </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

</body>
</html>
