<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 //$route['login'] = 'home/login';
  $route['register'] = 'home/register';
  $route['check'] = 'home/checkuser';
  $route['groups/(:any)'] = 'home/show_groups/$1';
  $route['register_user'] = 'home/register_user';
  $route['create_group'] = 'home/create_group';
 // $route['test/(:any)'] = 'home/test/$1';
 $route['testajax/(:any)'] = 'home/testajax/$1';

//  $route['create_group'] = 'home/create_group';

 //working
  $route['show_transaction/(:any)'] = 'home/group_detail/$1';
  $route['search_all_friends'] = 'home/search_all_friends';
  $route['send_friend_request'] = 'home/send_friend_request';
  $route['accept_friend_request'] = 'home/accept_friend_request';
  $route['reject_friend_request'] = 'home/reject_friend_request';


  $route['create_transaction/(:any)'] = 'home/create_transaction/$1';
  $route['insertt'] = 'home/insertt';
  $route['edit_transaction'] = 'home/edit_transaction';
  $route['store_group'] = 'home/store_group';
  $route['post_login'] = 'home/post_login';
  $route['show_groups'] = 'home/show_groups';
  $route['logout'] = 'home/logout';
 
 //friends routes
//  $route['search_friends'] = 'home/post_search_friends';

///Apis routes here
$route['registerapi'] = 'testapi/register';
$route['loginapi'] = 'testapi/login';
$route['group_detailapi'] = 'testapi/group_detail';
$route['store_groupapi'] = 'testapi/store_group';
$route['search_friendsapi'] = 'testapi/search_friends';
$route['search_country_friendsapi'] = 'testapi/search_country_friends';
$route['send_friend_requestapi'] = 'testapi/send_friend_request';
$route['accept_friend_requestapi'] = 'testapi/accept_friend_request';
$route['reject_friend_requestapi'] = 'testapi/reject_friend_request';
$route['logoutapi'] = 'testapi/logout';

$route['sendmessage'] = 'testapi/send_msg';
///Apis routes end

 $route['default_controller'] = 'Home';
 $route['404_override'] = '';
 $route['translate_uri_dashes'] = FALSE;
