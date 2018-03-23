<?php
$configs = [
	'application'=>[
		'name'=>'本意礼品',
		'identifie'=>'shuozhuo_benyilipin',
		'version'=>'1.1',
		'type'=>'activity',
		'description'=>'本意礼品小程序',
		'author'=>'lvtingting',
		'url'=>''
	],
	'bindings'=>[
		'menu'=>[
			['title'=>'订单管理','do'=>'orders'],
			['title'=>'用户管理','do'=>'users'],
			['title'=>'商品管理','do'=>'goods']
		],
	],
	'supports'=>[
		'app'=>true,
		'wxapp'=>true
	]
];
return $configs;