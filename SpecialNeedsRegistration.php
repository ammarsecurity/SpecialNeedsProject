<?php
include 'inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($sId === '1' || $sId === '2') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSpecialNeedsRegistration'])) {

  $addSpecial = $users->addSpecialNeedsRegistration($_POST);
}


if (isset($_GET['removechild'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['removechild']);
  $removeUser = $users->deletechild($remove);
}


if (isset($addSpecial)) {
  echo $addSpecial;
}


 ?>


 <div class="card ">
   <div class="card-header">
          <h3 class='text-center'>Special Needs Registration</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <label for="name">Child name</label>
                  <input type="text" name="child_name"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="username">Child Age</label>
                  <input type="number" name="child_age"  class="form-control">
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="sel1">Child Special Type</label>
                    <select class="form-control" name="child_special_type" id="child_special_type">
					   <?php

                      $SpecialTypes = $users->selectSpecialTypesData();

                      if ($SpecialTypes) {
                        $i = 0;
                        foreach ($SpecialTypes as  $value) {
                          $i++;

                     ?>
                      <option value="<?php echo $value->id; ?>"><?php echo $value->specialType_Name; ?></option>
					  
					   <?php }}else{ ?>
                      <tr class="text-center">
                      <td> <option value="0">Please add types</option></td>
                    </tr>
                    <?php } ?>
                 
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="addSpecialNeedsRegistration" class="btn btn-success">Add</button>
                </div>


            </form>
          </div>
		    <div class="card-body pr-2 pl-2">
<table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">SL</th>
                      <th  class="text-center">Child Name</th>
                      <th  class="text-center">Child Age</th>
                      <th  class="text-center">Special type</th>
                      <th  class="text-center">Add By</th>
                      <th  class="text-center">Created</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $Allchildren = $users->selectAllchildren();

                      if ($Allchildren) {
                        $i = 0;
                        foreach ($Allchildren as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("id") == $value->id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->child_name; ?></td>
                        <td><?php echo $value->child_age; ?></td>
                        <td><?php echo $value->specialType_Name; ?></td>
                        <td><?php echo $value->username; ?></td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>

                        <td>
                          <?php if ( Session::get("roleid") == '1') {?>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?removechild=<?php echo $value->id;?>">Remove</a>



                        <?php } ?>

                        </td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No Special Children availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>
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
