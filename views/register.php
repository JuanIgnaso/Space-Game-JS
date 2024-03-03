<?php
use juanignaso\phpmvc\framework\form\Form;

$this->title = 'Registrarse';
?>

<h1 class="page-header">Registrar nuevo Usuario</h1>

<main>
    <form class="w-1/3 flex flex-col gap-5 m-auto mt-3 p-3" action="" method="post">

        <label class="input-label">
            Nombre
            <div class="input-wrap">
                <input type="text" name="nombre" id="nombre" class="outline-none input-field"
                    value="<?php echo isset($model->nombre) ? $model->nombre : ''; ?>">
                <img src="/resources/svg/profile-user-icon.svg" class="form-icon icon" alt="">
            </div>
            <!-- mensajes de error van aquí -->
            <p class="input-error">
                <?php echo isset($model->errors['nombre']) ? $model->getFirstError('nombre') : ''; ?>
            </p>
        </label>

        <label class="input-label">
            Email
            <div class="input-wrap">
                <input type="text" name="email" id="email" class="input-field"
                    value="<?php echo isset($model->email) ? $model->email : ''; ?>">
                <img src="/resources/svg/email_icon.svg" class="form-icon icon" alt="">
            </div>
            <p class="input-error">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class="input-label">
            Contraseña

            <div class="input-wrap">
                <input type="password" name="password" id="password" class="input-field"
                    value="<?php echo isset($model->password) ? $model->password : ''; ?>">
                <img src="/resources/svg/input-svgrepo-com.svg" class="form-icon icon" alt="">
            </div>
            <p class="input-error">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <label class="input-label">
            Confirmar Contraseña
            <div class="input-wrap">
                <input type="password" name="passwordConfirm" id="passwordConfirm" class="input-field"
                    value="<?php echo isset($model->passwordConfirm) ? $model->passwordConfirm : ''; ?>">
                <img src="/resources/svg/input-svgrepo-com.svg" class="form-icon icon" alt="">
            </div>
            <p class="input-error">
                <?php echo isset($model->errors['passwordConfirm']) ? $model->getFirstError('passwordConfirm') : ''; ?>
            </p>
        </label>

        <button type="submit" class="menu_button game-btn self-center">Registrar
            Cuenta</button>
    </form>
</main>