# README

# [webfan\MimeStubAPC](https://github.com/frdl/mime-stub/tree/master/src/webfan)

* Dowload an example implementation at http://www.webfan.de/install/
* [Example](https://github.com/frdl/mime-stub/blob/master/tests/test.mime-stub.php)
 
```php
<?php 

   $vm = \webfan\MimeStubAPC::vm();
 
 // echo print_r($vm, true);
 
 $newFile = __DIR__. DIRECTORY_SEPARATOR . 'TestMimeStubAPC.php';
 
 
 $a = <<<PHPE
 
 echo ' TEST-modified.';
 
 PHPE;
 
 
 $stub = $vm->get_file($vm->document, '$HOME/index.php', 'stub index.php')
 // ->clear()
   ->append($a)
 ;
 
  $vm->to('hello@wor.ld');
  $vm->from('me@localhost');
  $stub->from('hello@wor.ld');  
     
  $vm->location = $newFile;
 require $newFile;
 $run($newFile);

```


# [Riverline\MultiPartParser](https://github.com/Riverline/multipart-parser)

[Homepage](https://travis-ci.org/Riverline/multipart-parser)

[![Build Status](https://travis-ci.org/Riverline/multipart-parser.svg?branch=master)](https://travis-ci.org/Riverline/multipart-parser)

## What is Riverline\MultiPartParser

``Riverline\MultiPartParse`` is a one class lib to parse multipart document ( multipart email, multipart form, etc ...) and manage each part encoding and charset to extract their content.

## Requirements

* PHP 5.3 or HHVM

## Installation

``Riverline\MultiPartParse`` is compatible with composer and any prs-0 autoloader.

```
composer require riverline/multipart-parser
```

## Usage

```php
<?php

use Riverline\MultiPartParser\Part;

$content = <<<EOL
User-Agent: curl/7.21.2 (x86_64-apple-darwin)
Host: localhost:8080
Accept: */*
Content-Type: multipart/form-data; boundary=----------------------------83ff53821b7c

------------------------------83ff53821b7c
Content-Disposition: form-data; name="foo"

bar
------------------------------83ff53821b7c
Content-Transfer-Encoding: base64

YmFzZTY0
------------------------------83ff53821b7c
Content-Disposition: form-data; name="upload"; filename="text.txt"
Content-Type: text/plain

File content
------------------------------83ff53821b7c--
EOL;

$document = new Part($content);

if ($document->isMultiPart()) {
    $parts = $document->getParts();
    echo $parts[0]->getBody(); // Output bar
    // It decode encoded content
    echo $parts[1]->getBody(); // Output base64

    // You can also filter by part name
    $parts = $document->getPartsByName('foo');
    echo $parts[0]->getName(); // Output foo

    // You can extract the headers
    $contentDisposition = $parts[0]->getHeader('Content-Disposition');
    echo $contentDisposition; // Output Content-Disposition: form-data; name="foo"
    // Helpers
    echo Part::getHeaderValue($contentDisposition); // Output form-data
    echo Part::getHeaderOption($contentDisposition, 'name'); // Output foo

    // File helper
    if ($parts[2]->isFile()) {
        echo $parts[2]->getFileName(); // Output text.txt
        echo $parts[2]->getMimeType(); // Output text/plain
    }
}
```
