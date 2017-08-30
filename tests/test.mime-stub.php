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
$vm->location = $newFile; // this saves the stub-php-file to $newFile 

//Test the new stub and call/run the $newFile, should be like calling the file in the browser!
require $newFile;
$run($newFile);
