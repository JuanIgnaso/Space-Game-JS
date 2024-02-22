<?php
$this->title = 'Login';
?>
<h1 class="text-center">Iniciar Sesión</h1>

<main>
    <form class="flex flex-col w-1/3 m-auto p-3" action="" method="post">

        <label class=" flex flex-col mb-4 text-red-400">
            Email
            <input type="text" name="email" id="email" class="bg-neutral-900 border-4  border-white text-white"
                value="<?php echo isset($model->email) ? $model->email : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col mb-4 text-red-400">
            Contraseña
            <input type="password" name="password" id="password" class="bg-neutral-900 border-4 border-white text-white"
                value="<?php echo isset($model->password) ? $model->password : ''; ?>">
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>
        <input type="submit" value="Iniciar Sesión" class="self-center text-white p-3 border-4 border-white">
    </form>
</main>