<?php

$this->load->view('layout/header',$user);
$this->load->view('notifications');
$this->load->view($view_page);
$this->load->view('layout/footer');
?>