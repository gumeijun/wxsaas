<?php
$configs = [
	'application'=>[
		'name'=>'本意礼品',
		'identifie'=>'shuozhuo_benyilipin',
		'version'=>'1.0',
		'type'=>'wxapp',
		'description'=>'本意礼品小程序',
		'author'=>'lvtingting',
		'url'=>''
	],
	'bindings'=>[
		'menu'=>[
			['title'=>'订单管理','action'=>'index','ctroller'=>'Index'],
			['title'=>'用户管理','action'=>'show','ctroller'=>'Login']
		],
	],
];
return $configs;