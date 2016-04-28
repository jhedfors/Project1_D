<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>WishList</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php
    $first_name = $this->session->userdata('first_name');

    $active_id = $this->session->userdata('active_id');
   ?>
   <div class="row">
     <div class="col s12">
       <a href="/logout">Logout</a>
     </div>
   </div>
   <div class="row">
     <div class="col s12">
       <h4>Welcome, <?php echo $first_name; ?>!</h4>
       <div class="row">
         <div class="col s12">
           <h5>
             Your Wish List
           </h5>

          <table>
            <thead>
              <tr>
                <th>
                  Item
                </th>
                <th>
                  Added by
                </th>
                <th>
                  Date Added
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
            <?php
               foreach ($data['on_list'] as $on_list) {
                 echo "<tr>";
                 echo "<td><a href='/wish_items/".$on_list['item_id']."'>".$on_list['description']."</a></td>";
                 echo "<td>".$on_list['first_name']."</td>";
                 echo "<td>".$on_list['date_added']."</td>";
                 if ($on_list['user_id'] == $active_id) {
                    echo "<td><a href='/main/delete_item/".$on_list['item_id']."'>Delete</a></td>";
                 }
                 else {
                     echo "<td><a href='/remove_from_list/".$on_list['item_id']."'>Remove from List</a></td>";
                 }

                 echo "</tr>";
                 // var_dump($not_on_list);

               }
             ?>
            </tbody>
          </table>

           <h5>
             Other User's Wish List
           </h5>
           <table>
             <thead>
               <tr>
                 <th>
                   Item
                 </th>
                 <th>
                   Added by
                 </th>
                 <th>
                   Date Added
                 </th>
                 <th>
                   Action
                 </th>
               </tr>
             </thead>
             <tbody>
             <?php
                foreach ($data['not_on_list'] as $not_on_list) {
                  echo "<tr>";
                 echo "<td><a href='/wish_items/".$not_on_list['item_id']."'>".$not_on_list['description']."</a></td>";
                  echo "<td>".$not_on_list['first_name']."</td>";
                  echo "<td>".$not_on_list['date_added']."</td>";
                  echo "<td><a href='/add_to_list/".$not_on_list['item_id']."'>Add to my wishlist</a></td>";
                  echo "</tr>";
                  // var_dump($not_on_list);

                }
              ?>
             </tbody>
           </table>
           <p>
             <a href="/add">Add Item</a>
           </p>

         </div>
         <div class="errors">
           <?php
           $errors = $this->session->userdata('errors_add');
           if ($errors) {
             foreach ($errors as $error) {
               echo $error;
             }
             $this->session->unset_userdata('errors_add');
           }

           ?>


         </div>

       </div>
     </div>
   </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

</body>
</html>
