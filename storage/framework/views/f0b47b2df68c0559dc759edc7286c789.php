<!DOCTYPE html>
<html>
<head>
    <title>Exception Occurred</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #cc0000; }
        pre { background-color: #f9f9f9; border: 1px solid #ccc; padding: 10px; }
    </style>
</head>
<body>
<h1>An Exception Occurred</h1>
<p><strong>Message:</strong> <?php echo e($exceptionMessage); ?></p>
<p><strong>File:</strong> <?php echo e($exceptionFile); ?></p>
<p><strong>Line:</strong> <?php echo e($exceptionLine); ?></p>
<p><strong>Previous Exception:</strong> <?php echo e($exceptionPrevious); ?></p>
<p><strong>Trace:</strong></p>
<pre><?php echo e($exceptionTrace); ?></pre>
</body>
</html>
<?php /**PATH C:\Users\muham\OneDrive\Desktop\KurdGram\GitHub-Pc\SocialMedia\resources\views/exception_report.blade.php ENDPATH**/ ?>