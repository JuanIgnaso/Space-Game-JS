<?php

namespace app\controllers;

use juanignaso\phpmvc\framework\Controller;

class GamesController extends Controller
{
    public function scores()
    {
        return $this->render('scoreBoard');
    }
}