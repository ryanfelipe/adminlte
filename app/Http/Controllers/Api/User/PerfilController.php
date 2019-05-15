<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\GenericController;
use App\User;

class PerfilController extends GenericController
{
      public function __construct(User $user)
      {
             parent::__construct($user);             
      }

      public function __destruct()
      {
            parent::__destruct();          
      }

}
