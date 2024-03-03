<?php
$this->title = 'Login';
?>
<h1 class="page-header">Iniciar Sesión</h1>

<main>
    <form class="flex flex-col gap-5 w-1/3 m-auto mt-3 p-3" action="" method="post">

        <label class="input-label">
            Email
            <div class="input-wrap">
                <input type="text" name="email" id="email" class="input-field"
                    value="<?php echo isset($model->email) ? $model->email : ''; ?>"> <img
                    src="/resources/svg/email_icon.svg" class="form-icon icon" alt="">
            </div>
            <p class="input-error">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class="input-label">
            Contraseña
            <div class="input-wrap">
                <input type="password" name="password" id="password" class="input-field"
                    value="<?php echo isset($model->password) ? $model->password : ''; ?>"><img
                    src="/resources/svg/input-svgrepo-com.svg" class="form-icon icon" alt="">
            </div>
            <p class="input-error">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>

        <!-- REMEMBER ME CHECKBOX -->
        <label class="relative w-full flex mb-4 gap-2 text-red-400 items-center justify-center">
            Guardar Sesión
            <input class="peer absolute opacity-0 cursor-pointer h-0 w-0" type="checkbox" name="remember_me"
                id="remember_me" value="checked">
            <span
                class="flex text-sm justify-center items-center peer-checked:after:content-['*'] peer-checked:after:visible after:content-[''] afther:invisible afther:m-auto relative size-7 border-4 border-purple-400 bg-neutral-900"></span>
        </label>
        <!--  -->

        <input type="submit" value="Iniciar Sesión" class="self-center menu_button game-btn">
    </form>
</main>