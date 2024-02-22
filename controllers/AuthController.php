<?php

namespace app\controllers;

use app\models\LoginForm;
use juanignaso\phpmvc\framework\Controller;
use juanignaso\phpmvc\framework\middlewares\LoggedMiddleware;
use juanignaso\phpmvc\framework\Request;
use juanignaso\phpmvc\framework\Response;
use juanignaso\phpmvc\framework\Usuario;
use juanignaso\phpmvc\framework\Application;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->loggedMiddleware(new LoggedMiddleware(['login', 'register']));
    }

    public function register(Request $request)
    {
        $user = new Usuario();

        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                /*
                -Loguear cuenta registrada-
                Si llegamos aquí, quiere decir que el registro ya existe en la tabla.
                */
                $body = $request->getBody();
                $formModel = new LoginForm();
                $formModel->loadData(['email' => $body['email'], 'password' => $body['password']]);
                $formModel->login();

                //Application::$app->session->setFlash('success', "Usuario registrado, bienvenido/a " . $body['nombre'] . "!");
                Application::$app->response->redirect('/');
            }

        }
        return $this->render('register', [
            'model' => $user,
        ]);
    }



    public function login(Request $request, Response $res)
    {
        $model = new LoginForm();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->login()) {
                $res->redirect('/');
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}