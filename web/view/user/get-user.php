<?php
# get-user.php 


$entityManager  = require_once join(DIRECTORY_SEPARATOR,[__DIR__,'..','..','..','config','bootstrap.php']);

use App\Entity\User;

//$user =  $entityManager->find(User::class, 1);

$userRepo = $entityManager->getRepository(User::class);

    //$user = $userRepo->find(1);
    //echo get_class($user->getAddress());
    $userRepo->test();



class CallableClass
{
    public function __invoke($x)
    {
        return ($x);
    }
}


$obj = new CallableClass;
$obj(5);
print_r($obj);
var_dump(is_callable($obj));



exit;
$user = $userRepo->findAll();
echo "<pre>";
print_r($user);

