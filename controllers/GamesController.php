<?php

namespace app\controllers;

use app\models\Games;
use juanignaso\phpmvc\framework\Application;
use juanignaso\phpmvc\framework\Controller;
use juanignaso\phpmvc\framework\Request;

class GamesController extends Controller
{
    /**
     * Muestra los scores del juego
     */
    public function scores(Request $request)
    {
        $model = new Games();
        $scores = $model->getHighScore();
        $global = true;

        if ($request->isGet()) {
            //Si personal está presente en la url recogemos solo los del usuario registrado
            $body = $request->getBody();
            if (isset($body['personal'])) {
                $scores = $model->getPersonalScores();
                $global = false;
            }
        }
        return $this->render('scoreBoard', [
            'topGames' => $scores,
            'global' => $global,
        ]);
    }

    public function saveGame(Request $request)
    {
        if ($request->isPost()) {
            $model = new Games();
            $model->loadData($request->getBody());
            if ($model->saveGame()) {
                Application::$app->response->setStatusCode(200);
                exit;
            } else {
                Application::$app->response->setStatusCode(400);
                echo json_encode(['error' => 'No se ha podido realizar la operación']);
                exit;
            }
        }
    }
}