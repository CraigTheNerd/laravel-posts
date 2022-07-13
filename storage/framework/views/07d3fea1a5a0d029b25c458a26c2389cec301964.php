<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <title>Posty</title>
</head>
<body class="bg-gray-200">

    
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li class="p-3">
                <a href="/">Home</a>
            </li>
            <li class="p-3">
                <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            </li>
            <li class="p-3">
                <a href="<?php echo e(route('posts')); ?>">Posts</a>
            </li>
        </ul>

        <ul class="flex items-center">
            <?php if(auth()->guard()->check()): ?>
                <li class="p-3">
                    <a href=""><?php echo e(auth()->user()->name); ?></a>
                </li>
                <li class="p-3">
                    <form action="<?php echo e(route('logout')); ?>" method="post" class="p-3 inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Logout</button>
                    </form>
                </li>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
                    <li class="p-3">
                        <a href="<?php echo e(route('login')); ?>">Login</a>
                    </li>
                    <li class="p-3">
                        <a href="<?php echo e(route('register')); ?>">Register</a>
                    </li>
            <?php endif; ?>
        </ul>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH /Users/Craig/Sites/localhost/laravelcrashcourse.lan/posty/resources/views/layouts/app.blade.php ENDPATH**/ ?>