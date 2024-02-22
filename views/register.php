<?php
use juanignaso\phpmvc\framework\form\Form;

$this->title = 'Registrarse';
?>

<h1 class="text-center">Registrar nuevo Usuario</h1>

<main>
    <form class="w-1/3 flex flex-col gap-5 m-auto" action="" method="post">

        <label class="flex flex-col gap-2 text-red-400">
            Nombre
            <input type="text" name="nombre" id="nombre"
                class="outline-none focus:border-green-400 text-white bg-neutral-900 border-4 border-white"
                value="<?php echo isset($model->nombre) ? $model->nombre : ''; ?>">
            <!-- mensajes de error van aquí -->
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['nombre']) ? $model->getFirstError('nombre') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col gap-2 text-red-400">
            Email
            <input type="text" name="email" id="email"
                class="focus:border-green-400 text-white bg-neutral-900 border-4 border-white"
                value="<?php echo isset($model->email) ? $model->email : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col gap-2 text-red-400">
            Contraseña
            <input type="password" name="password" id="password"
                class="focus:border-green-400 text-white bg-neutral-900 border-4 border-white"
                value="<?php echo isset($model->password) ? $model->password : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col gap-2 text-red-400">
            Confirmar Contraseña
            <input type="password" name="passwordConfirm" id="passwordConfirm"
                class="focus:border-green-400 bg-neutral-900 border-4 text-white border-white"
                value="<?php echo isset($model->passwordConfirm) ? $model->passwordConfirm : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['passwordConfirm']) ? $model->getFirstError('passwordConfirm') : ''; ?>
            </p>
        </label>

        <button type="submit" class="text-white p-3 border-4 border-white self-center">Registrar Cuenta</button>
    </form>
</main>