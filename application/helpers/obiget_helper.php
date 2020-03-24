<?php

function getcategory($id){
	$CI =& get_instance();
	$CI->load->model('M_myweb');
	$get = $CI->M_myweb->set_table('categories')->set('id',$id)->get();
	return $get;
}