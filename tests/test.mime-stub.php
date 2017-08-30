<?php
$vm = \webfan\MimeStubAPC::vm();

// echo print_r($vm, true);


$newFile = __DIR__. DIRECTORY_SEPARATOR . 'test-my-install-index.php';

$a = <<<PHPE
echo '<br />TEST-modified.';
PHPE;

$vm->get_file($vm->document, '$HOME/index.php', 'stub index.php')
  ->append($a)
;


$fcont = <<<PHP
Content-Type: image/x-icon
Content-Disposition: httpd ;filename="\$HOME/\$WEB/images/apc.ico";name="\$WEB /images/apc.ico"




PHP;
 
$fcont.= file_get_contents('http://webfan.de/cdn/frdl/flow/components/frdl/webfan/icon.ico');
$attachPart = $vm->get_file($vm->document, '$__FILE__/attach.zip', 'archive attach.zip');
$attachPart->append($fcont);  //  test-my-install-index.php?web=/images/apc.ico



 	
 $fcont = <<<PHP
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: httpd ;filename="\$HOME/\$WEBtest.php";name="\$WEB test.php"




<?php
\$test = new \webfan\InstallShield\apc\Test();
\$test->run();

PHP;
 

$attachPart->append($fcont);	//  test-my-install-index.php?web=test.php

 	
 	



$vm->location = $newFile; // this saves the stub-php-file to $newFile 

//Test the new stub and call/run the $newFile, should be like calling the file in the browser!
require $newFile;
$run($newFile);
