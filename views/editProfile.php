<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'Edit My Profile';
?>

<h1 class="page-header">Editar Mi Perfil</h1>
<main>
    <form class="flex flex-col w-1/3 m-auto p-3 gap-5" action="" method="post">

        <label class="form-group">
            Nombre
            <input type="text" name="nombre" id="nombre" class="input-field"
                value="<?php echo isset($userData->nombre) ? $userData->nombre : ''; ?>">
            <!-- mensajes de error van aquí -->
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['nombre']) ? $model->getFirstError('nombre') : ''; ?>
            </p>
        </label>

        <label class="form-group">
            Email
            <input type="text" name="email" id="email" class="input-field"
                value="<?php echo isset($userData->email) ? $userData->email : ''; ?>">
            <p class="input-error">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class="form-group">
            Contraseña
            <input type="password" name="password" id="password" class="input-field">
            <p class="input-error">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <label class="form-group">
            Confirmar Nueva Contraseña
            <input type="password" name="passwordConfirm" id="passwordConfirm" class="input-field">
            <p class="input-error">
                <?php echo isset($model->errors['passwordConfirm']) ? $model->getFirstError('passwordConfirm') : ''; ?>
            </p>
        </label>

        <input type="submit" value="Aplicar Cambios" class="self-center game-btn">
    </form>

</main>