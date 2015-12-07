<?php
 function redirect_back(){
	redirect($_SERVER['HTTP_REFERER']);
}
?>