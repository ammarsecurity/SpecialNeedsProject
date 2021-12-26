<?php
include 'inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1' || $sId === '2') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSpecialType'])) {

  $addSpecial = $users->addSpecialType($_POST);
}

if (isset($addSpecial)) {
  echo $addSpecial;
}


 ?>


 <div class="card ">
   <div class="card-header">
          <h3 class='text-center'>Add Special Type</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="name">Special Type Name</label>
                  <input type="text" name="SpecialTypeName"  class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="addSpecialType" class="btn btn-success">Add</button>
                </div>


            </form>
          </div>


        </div>
      </div>

<?php
}else{

  header('Location:index.php');



}
 ?>

  <?php
  include 'inc/footer.php';

  ?>
