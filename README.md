# BMVC-Framework
This is a very simple framework used as an example of how to create a basic framework, not for production use

在原基础上，调整了架构同时增强了路由与load、加上数据库处理类等等


# 获取get/post
使用get函数，例如 ?a=12345，代码中使用get('a')可以获取到get参数a，同理post一样

# 路由模式
修改config.php中的url_mode参数可以修改站点的路由规则

模式1 —— 1
常规 c=控制器 m=方法，例如：?c=index&m=index

模式2 —— 2
通过后续的/路由，例如 /index/test/3 ，指向indexController.php中的test方法，并将3传递到test方法作为参数

# layout
默认layout位于application/views/layout/default.php
可以动态改变layout，$this->load->set_layout('new');

# helper
helper位于application的helper目录，请确保helper文件的命名遵从 [名]_helper.php 这个格式
动态加载helper，$this->load->helper('app_helper');

# library
library位于application的library目录，请确保helper文件的命名遵从 [名].php 这个格式
	$test = $this->load->library('test');
	$test->a();