
<style type="text/css">
  th {
    text-align: center;
  }
  td{
   text-align: left;
 }
 .input-group .input-group-btn .btn.search{
   border-radius: 0;
   padding: 6px 9px;
 }
 .input-group{
  position: relative;
  top: 12px;
}
.input-group-btn {
  font-size: 0;
  position: absolute;
  right: 27px;
  top: 1px;
  white-space: nowrap;
}
.user_select{
  position: relative;
  top: 12px;
}
</style>
<div class="container">
  <br />
  <!-- search -->




  <div class="row">
    <div class="col-md-4">
     <a href="<?= site_url('users') ?>" class="btn btn-primary"><i class="fa fa-users"></i> Manage users</a>
   </div>
   <div class="col-md-6 col-md-offset-2">
     <form method="get" action="<?= site_url('admin/dashboard') ?>">
       <div class="form-group col-md-6 user_select">
         <select class="form-control" name="search_select">
           <option value=""> All users</option>
           <?php foreach ($user_details as $value) {

            ?>
            <option value="<?=$value->id?>" <?= ($this->input->get('search_select') == $value->id)?'selected':'' ?>> <?=$value->name?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <!--  <form method="get" action="<?= site_url('admin/dashboard') ?>"> -->
          <div class="input-group pull-right">
           <input type="text" name="search" value="<?=$this->input->get('search')?>" class="form-control" placeholder="Search here..." />
           <span class="input-group-btn"><button class="btn btn-primary search btn-flat" type="submit"><i class="fa fa-search"></i></button></span>
         </div>
       </div>
     </form>
     <div class="clearfix"></div>
   </div>
 </div>

<div class="row">
    <div class="col-md-12">
      <br />
      <table class="table table-bordered table-hover" width="100%">

        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Location</th>
          <th>PIN</th>
          <th>Website</th>
          <th>Phone</th>
          <th>Created by</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>

        <tr>
          <?php
          foreach ($details as $details) {
           ?>
           <td><?=$details->name?></td>
           <td><?=$details->email?></td>
           <td><?=$details->address?></td>
           <td><?=$details->location?></td>
           <td><?=$details->pin?></td>
           <td><?=$details->website?></td>
           <td><?=$details->phone?></td>
           <td><?=$details->created_by?></td>
           <td><?= Carbon\Carbon::createFromTimestamp(strtotime($details->created_at))->diffForHumans() ?></td>
           <td>
            <a href="<?= site_url('dashboard/view/'.$details->id) ?>" title="view"><i class="fa fa-eye"></i></a>
            <a href="<?= site_url('dashboard/edit/'.$details->id) ?>" title="edit"><i class="fa fa-edit"></i></a>
            <a href="<?= site_url('dashboard/delete/'.$details->id) ?>" title="delete"><i class="fa fa-trash-o"></i></a>
          </td>

        </tr>
        <?php
      }
      ?>
    </table>

    <a href="<?=site_url('dashboard')?>" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i> Back</a>
    <?php echo $this->pagination->create_links(); ?>

  </div>
</div>
</div>



    <!--     </div>
  </div> -->
</div>