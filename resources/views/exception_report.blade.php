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
<p><strong>Message:</strong> {{ $exceptionMessage }}</p>
<p><strong>File:</strong> {{ $exceptionFile }}</p>
<p><strong>Line:</strong> {{ $exceptionLine }}</p>
<p><strong>Previous Exception:</strong> {{ $exceptionPrevious }}</p>
<p><strong>Trace:</strong></p>
<pre>{{ $exceptionTrace }}</pre>
</body>
</html>
