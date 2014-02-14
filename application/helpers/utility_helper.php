<?php
    function asset_url(){
   		return base_url().'assets/';
	}
	
	function prettify($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	
	// MM/DD/YYYY ---> YYYY-MM-DD 	
	function convert_to_datetime_format($date = NULL){
		return $date == NULL ? NULL : date('Y-m-d', strtotime(str_replace('-', '/', $date)));
	}
	