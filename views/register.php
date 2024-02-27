<?php
use juanignaso\phpmvc\framework\form\Form;

$this->title = 'Registrarse';
?>

<h1 class="text-center text-red-400">Registrar nuevo Usuario</h1>

<main>
    <form class="w-1/3 flex flex-col gap-5 m-auto" action="" method="post">

        <label class="flex flex-col gap-2 items-center text-red-400">
            Nombre
            <div class="flex space-x-6 items-center relative">
                <input type="text" name="nombre" id="nombre"
                    class="outline-none focus:border-purple-400 text-white bg-neutral-900 border-4 border-lime-300"
                    value="<?php echo isset($model->nombre) ? $model->nombre : ''; ?>">
                <img src="/resources/svg/profile-user-icon.svg"
                    class="absolute right-full pr-3 form-icon size-14 hidden md:block" alt="">
            </div>
            <!-- mensajes de error van aquí -->
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['nombre']) ? $model->getFirstError('nombre') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col gap-2 items-center text-red-400">
            Email
            <div class="flex space-x-6 items-center relative">
                <input type="text" name="email" id="email"
                    class="focus:border-purple-400 text-white bg-neutral-900 border-4 border-lime-300"
                    value="<?php echo isset($model->email) ? $model->email : ''; ?>">
                <img src="/resources/svg/email_icon.svg"
                    class="form-icon absolute right-full pr-3 size-14 hidden md:block" alt="">
            </div>
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class="flex flex-col items-center gap-2 text-red-400">
            Contraseña

            <div class="flex space-x-6 items-center relative">
                <input type="password" name="password" id="password"
                    class="focus:border-purple-400 text-white bg-neutral-900 border-4 border-lime-300"
                    value="<?php echo isset($model->password) ? $model->password : ''; ?>">
                <img src="/resources/svg/input-svgrepo-com.svg"
                    class="absolute right-full pr-3 form-icon size-14 hidden md:block" alt="">
            </div>
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col gap-2 items-center text-red-400">
            Confirmar Contraseña
            <div class="flex space-x-6 items-center relative">
                <input type="password" name="passwordConfirm" id="passwordConfirm"
                    class="focus:border-purple-400 bg-neutral-900 border-4 text-white border-lime-300"
                    value="<?php echo isset($model->passwordConfirm) ? $model->passwordConfirm : ''; ?>">
                <img src="/resources/svg/input-svgrepo-com.svg"
                    class="absolute right-full pr-3 form-icon size-14 hidden md:block" alt="">
            </div>
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['passwordConfirm']) ? $model->getFirstError('passwordConfirm') : ''; ?>
            </p>
        </label>

        <button type="submit"
            class="text-red-400 p-3 border-4 border-purple-400 hover:animate-pulse self-center">Registrar
            Cuenta</button>
    </form>
</main>