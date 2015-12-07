<?php
if($this->session->flashdata('success')){
	?>
	<div class="alert alert-success text-center">
		 <?=$this->session->flashdata('success')?>
	</div>
	<?php
}
if($this->session->flashdata('error')){
	?>
	<div class="alert alert-danger text-center">
		<i class="fa fa-warning"></i> <?=$this->session->flashdata('error')?>
	</div>
	<?php
}
?>