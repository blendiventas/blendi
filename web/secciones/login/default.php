<section class="py-20 bg-gray-100 overflow-x-hidden">
    <div class="container px-4 mx-auto">
        <div class="max-w-4xl mx-auto bg-blue-300">
            <div class="relative max-w-xl mx-auto px-6 pt-20 pb-32 text-center">
                <img class="hidden md:block absolute top-0 -right-1/2 -mr-16" src="<?php echo $host_web; ?>assets/elements/white-sign-line.svg" alt="">
                <img class="absolute bottom-0 -left-1/2 -ml-24" src="<?php echo $host_web; ?>assets/elements/orange-sign-line.svg" alt="">
                <img class="absolute bottom-0 -right-1/2 -mb-12 -mr-40" src="<?php echo $host_web; ?>assets/elements/purple-sign-line.svg" alt="">
                <h2 class="mb-20 max-w-md mx-auto text-4xl text-white font-bold font-heading">Login</h2>
                <h3 class="mb-20 max-w-md mx-auto text-sm text-white font-bold font-heading cursor-pointer" onclick="window.location = '<?php echo $host_web_tienda; ?>signup';">Regístrate aquí si aún no tienes usuario</h3>
                <form action="<?php echo substr($host_web_tienda, 0, -1); ?>" method="post">
                    <input class="w-full mb-4 px-12 py-6 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" placeholder="micorreo@gmail.com" name="login_user">
                    <input class="w-full mb-4 px-12 py-6 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="password" placeholder="Password" name="login_password">
                    <button class="mt-12 md:mt-16 bg-blue-800 hover:bg-blue-900 text-white font-bold font-heading py-5 px-8 rounded-md uppercase" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</section>
