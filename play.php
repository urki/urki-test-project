<?php

require_once __DIR__.'/app/bootstrap.php.cache';
require_once __DIR__.'/app/AppKernel.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', Request::createFromGlobals());

$templating = $container->get('templating');

use Vdc\RegBundle\Entity\Rfid;

$Rfid = new Rfid();
$Rfid->setcajt('');
$Rfid->setPersonId('3');
$Rfid->setAction('prihod');

$em = $container->get('doctrine')->getEntityManager();

$em->persist($Rfid);
$em->flush();
