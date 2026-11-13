<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema en Funcionamiento</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-slate-800 px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-white tracking-wide">
                Sistema en Funcionamiento
            </h1>
            <form method="POST" class="m-0">
                <button type="submit" name="orden" value="Salir"
                    class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-1.5 px-3 rounded-md transition cursor-pointer">
                    Salir
                </button>
            </form>
        </div>

        <!-- Content -->
        <div class="p-6">
            
            <?php if (!empty($mensaje)): ?>
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm rounded">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <!-- Tabla de Productos -->
            <div class="overflow-x-auto rounded-lg border border-slate-200">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-right">Stock</th>
                            <th scope="col" class="px-6 py-3 text-right">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($tproductos as $producto): ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900"><?= $producto->id ?></td>
                            <td class="px-6 py-4 text-slate-800"><?= $producto->nombre ?></td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    <?= $producto->stock ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-900">
                                $<?= number_format((float)$producto->precio, 2) ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
</html>