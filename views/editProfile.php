<?php
use juanignaso\phpmvc\framework\Application;

$this->title = 'Edit My Profile';
?>

<h1 class="text-center">Edit my Profile</h1>
<main>
    <form class="flex flex-col w-1/3 m-auto p-3" action="" method="post">

        <label class="flex flex-col  mb-4 text-red-400">
            Nombre
            <input type="text" name="nombre" id="nombre" class="bg-neutral-900 border-4 text-white border-white"
                value="<?php echo isset($userData->nombre) ? $userData->nombre : ''; ?>">
            <!-- mensajes de error van aquí -->
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['nombre']) ? $model->getFirstError('nombre') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col  mb-4 text-red-400">
            Email
            <input type="text" name="email" id="email" class="bg-neutral-900 border-4 text-white border-white"
                value="<?php echo isset($userData->email) ? $userData->email : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col mb-4 text-red-400">
            Contraseña
            <input type="password" name="password" id="password"
                class="bg-neutral-900 border-4 text-white border-white">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col mb-4 text-red-400">
            Confirmar Nueva Contraseña
            <input type="password" name="passwordConfirm" id="passwordConfirm"
                class="bg-neutral-900 border-4 text-white border-white">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['passwordConfirm']) ? $model->getFirstError('passwordConfirm') : ''; ?>
            </p>
        </label>

        <input type="submit" value="Aplicar Cambios" class="self-center text-white p-3 border-4 border-white">
    </form>

</main>