<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border border-slate-200">
        
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-slate-800 tracking-wide uppercase">
                Acceso al Sistema
            </h1>
            <p class="text-sm text-slate-500 mt-1">Ingresa tus credenciales para continuar</p>
        </div>

        <!-- Content & Form -->
        <div>
            <?php if (!empty($mensaje)): ?>
                <div class="mb-4 p-3 bg-blue-50 border-l-4 border-blue-500 text-blue-700 text-sm rounded">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <form name="entrada" method="POST" class="space-y-4">
                
                <div>
                    <label for="login" class="block text-sm font-medium text-slate-700 mb-1">Identificador</label>
                    <input type="text" id="login" name="login" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800 text-sm transition">
                </div>

                <div>
                    <label for="passwd" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                    <input type="password" id="passwd" name="passwd" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800 text-sm transition">
                </div>

                <?php if (isset($activarcaptcha)): ?>
                    <div class="flex justify-center my-4">
                        <!-- Data-sitekey ofrecida por google -->
                        <div class="g-recaptcha" data-sitekey="6Ldpv......"></div>
                    </div>
                <?php endif; ?>

                <button type="submit" name="orden" value="Entrar"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-lg shadow hover:shadow-md transition duration-150 ease-in-out cursor-pointer">
                    Entrar
                </button>
            </form>
        </div>

    </div>

</body>
</html>