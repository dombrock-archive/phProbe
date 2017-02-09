<?php
$opt = array(//options
	"verbose"=>true,
	"export"=>true,
	"list" => "list.txt",
	"base" => "mzero.space",
	"cmd" => 'curl -L -s -o /dev/null -w "%{http_code}"',
);