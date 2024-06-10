<?php

$routeDirectory = __DIR__ . '/api/v1/';
$directoryIterator = new RecursiveDirectoryIterator($routeDirectory);
$iterator = new RecursiveIteratorIterator($directoryIterator);

while($iterator->valid())
{
    if(!$iterator->isDot()
      && $iterator->isFile()
      && $iterator->isReadable()
      && $iterator->current()->getExtension() ==='php')
      {
        require $iterator->key();
      }
      $iterator->next();
    
}




