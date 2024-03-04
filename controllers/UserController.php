<?php
namespace app\controllers;

use app\models\EditUserForm;
use juanignaso\phpmvc\framework\Application;
use juanignaso\phpmvc\framework\Controller;
use juanignaso\phpmvc\framework\middlewares\AuthMiddleware;
use juanignaso\phpmvc\framework\Request;
use juanignaso\phpmvc\framework\Response;
use juanignaso\phpmvc\framework\Usuario;

class UserController extends Controller
{

    public function __construct()
    {
        #restringir a usuarios no loggeados a la zona de notas.
        $this->registerMiddleware(new AuthMiddleware(['edit']));
    }

    public function edit(Request $request, Response $response)
    {
        $model = new Usuario();
        $user = Application::$app->user;
        if ($request->isPost()) {
            $arr = [//password_hash($this->password, PASSWORD_DEFAULT);
                'id' => Application::$app->user->id,
                'nombre' => $request->getBody()['nombre'],
                'email' => $request->getBody()['email'],
                'password' => $request->getBody()['password'],
            ];

            //validar
            if (empty($arr['nombre']) || !isset($arr['nombre'])) {
                $arr['nombre'] = $user->nombre;
            }
            if ($model->attrInUse($user->id, 'nombre', $arr['nombre'])) {
                $model->addError('nombre', 'El nombre que has escrito ya está en uso');
            }
            if (empty($arr['email'])) {
                $arr['email'] = $user->email;
            }
            if (!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
                $model->addError('email', 'Formato de email incorrecto');
            }
            if ($model->attrInUse($user->id, 'email', $arr['email'])) {
                $model->addError('email', 'El correo que has escrito ya está en uso');
            }
            if (!empty($arr['password'])) {
                if (!preg_match('/^[a-zA-Z0-9\*\?\-\_\@#\+]{8,20}$/', $arr['password'])) {
                    $model->addError('password', 'la contraseña debe contener de 8 a 20 caracteres, caracteres especiales permitidos: * ? - _ @ # +');
                } else
                    if ($arr['password'] != $request->getBody()['passwordConfirm']) {
                        $model->addError('passwordConfirm', 'La contraseña y confirmar contraseña deben de coincidir');
                    } else {
                        $arr['password'] = password_hash($arr['password'], PASSWORD_DEFAULT);
                    }
            } else {
                $arr['password'] = $user->password;
            }

            if (count($model->errors) == 0) {
                //Si no hay ningún error editamos
                $model->loadData($arr);
                if ($model->edit()) {
                    $response->redirect('/');
                }
            } else {
                $user->loadData($arr);
            }

        }
        return $this->render('editProfile', [
            'userData' => $user,
            'model' => $model,
        ]);
    }
}
