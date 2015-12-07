
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
    top: 8px;
}
.input-group-btn {
    font-size: 0;
    position: absolute;
    right: 27px;
    top: 1px;
    white-space: nowrap;
}
</style>
<div class="container">
 <div class="row">
     <div class="col-md-6">
     <form method="get" action="<?= site_url('dashboard') ?>">
         <div class="input-group">
          <input type="text" class="form-control" value="<?=$this->input->get('search')?>" placeholder="Search for..." name="search">
          <span class="input-group-btn"><button class="btn btn-primary search btn-flat" type="submit"><i class="fa fa-search"></i></button></span>
      </div><!-- /input-group -->
      </form>
  </div>
  <div class="col-md-6">
    <a href="<?= site_url('dashboard/add')?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add address</a>
    <div class="clearfix"></div>
</div>
</div>
<div class="row">
 <div class="col-md-12">
     <table class="table table-bordered table-hover" width="100%">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Location</th>
            <th>PIN</th>
            <th>Website</th>
            <th>Phone</th>
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
<?=$pagination?>

</div>
</div>
</div>