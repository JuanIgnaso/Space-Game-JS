<?php

namespace app\controllers;

use juanignaso\phpmvc\framework\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }
}