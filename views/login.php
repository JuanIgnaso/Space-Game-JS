<?php
$this->title = 'Login';
?>
<h1 class="text-center text-red-400">Iniciar Sesión</h1>

<main>
    <form class="flex flex-col w-1/3 m-auto p-3" action="" method="post">

        <label class=" flex flex-col mb-4 items-center text-red-400 gap-2">
            Email

            <div class="flex space-x-6 items-center relative">
                <input type="text" name="email" id="email"
                    class="bg-neutral-900 border-4 focus:border-purple-400 border-lime-300 text-white"
                    value="<?php echo isset($model->email) ? $model->email : ''; ?>"> <img
                    src="/resources/svg/email_icon.svg"
                    class="form-icon absolute right-full pr-3 size-14 hidden md:block" alt="">
            </div>


            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['email']) ? $model->getFirstError('email') : ''; ?>
            </p>
        </label>

        <label class=" flex flex-col mb-4 gap-2 text-red-400 items-center">
            Contraseña
            <div class="flex space-x-6 items-center relative">

                <input type="password" name="password" id="password"
                    class="bg-neutral-900 focus:border-purple-400 border-4 border-lime-300 text-white"
                    value="<?php echo isset($model->password) ? $model->password : ''; ?>"><img
                    src="/resources/svg/input-svgrepo-com.svg"
                    class="absolute right-full pr-3 form-icon size-14 hidden md:block" alt="">
            </div>
            <p class="font-bold text-red-800 text-xs">
                <?php echo isset($model->errors['password']) ? $model->getFirstError('password') : ''; ?>
            </p>
        </label>
        <input type="submit" value="Iniciar Sesión"
            class="self-center text-red-400 p-3 border-4 hover:animate-pulse border-purple-400">
    </form>
    <span class="block text-center m-auto text-white text-sm">Usuario de test: <strong
            class="text-red-400">miOTRqemail@mail.com</strong>
        -
        <strong class="text-red-400">password</strong></span>
</main>