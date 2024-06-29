<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Demo</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <style>
        
        body {
            background-color: #1e1e1e;
            color: #fff;
            padding-top: 20px;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
        }
        .api-info {
            margin-bottom: 30px;
        }
        .endpoint-list {
            list-style-type: none;
            padding-left: 0;
        }
        .endpoint-item {
            background-color: #2d2d2d;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .endpoint-item code {
            color: #fff;
        }
        .endpoint-method {
            font-weight: bold;
            margin-right: 5px;
        }
        .api-info h2 {
            border-bottom: 1px solid #666;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">API Endpoints</h1>
        
        <!-- User Endpoints -->
        <div class="api-info" style="margin-top:70px;">
            <h2 style="color:#9f8ff7;">User Endpoints</h2>
            <ul class="endpoint-list">
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/signup</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/login</code>
                </li>  
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c4141">DELETE</span>
                    <code>/api/v1/logout</code>
                </li>               
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/user</code>
                </li>       
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #41709c">PUT</span>
                    <code>/api/v1/user/update</code>
                </li>
            </ul>
        </div>

        <!-- Post Endpoints -->
        <div class="api-info">
            <h2 style="color:#8ff7b7">Post Endpoints</h2>
            <ul class="endpoint-list">
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/posts</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/posts/{id}</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/posts</code>
                </li>
            </ul>
        </div>

        <!-- Comment Endpoints -->
        <div class="api-info">
            <h2 style="color:#f78ff7">Comment Endpoints</h2>
            <ul class="endpoint-list">
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/comment/{id}</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/commnet/{id}</code>
                </li>           
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c4141">DELETE</span>
                    <code>/api/v1/commnet/{id}</code>
                </li>
        </div>

        <!--EmailVerification Endpoints -->
        <div class="api-info">
            <h2 style="color:#f7b98f">EmailVerification  Endpoints</h2>
            <ul class="endpoint-list">
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/verify</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/resend</code>
                </li>   
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/resend/{id}</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/email/verify</code>
                </li>  
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/email/test/{id}</code>
                </li>                                                        
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/verify/{token}</code>
                </li>  
        </div>

        <!-- Follow Endpoints -->
        <div class="api-info">
            <h2 style="color:#f78fba">Follow Endpoints</h2>
            <ul class="endpoint-list">
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/followers</code>
                </li>
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/followings</code>
                </li>                
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/follow/{id}</code>
                </li>           
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c4141">DELETE</span>
                    <code>/api/v1/unfollow/{id}</code>
                </li>
        </div>

        <!-- Like Endpoints -->
        <div class="api-info">
            <h2 style="color:#bef78f">Like Endpoints</h2>
            <ul class="endpoint-list">               
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/like/{id}</code>
                </li>           
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c4141">DELETE</span>
                    <code>/api/v1/like/{id}</code>
                </li>
        </div>

        <!-- Message Endpoints -->
        <div class="api-info">
            <h2 style="color:#8febf7">Message Endpoints</h2>
            <ul class="endpoint-list">               
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #419c41">GET</span>
                    <code>/api/v1/chat</code>
                </li>           
                <li class="endpoint-item">
                    <span class="endpoint-method" style="color: #9c7f41">POST</span>
                    <code>/api/v1/chat</code>
                </li>
        </div>        

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\muham\OneDrive\Desktop\KurdGram\GitHub-Pc\SocialMedia\resources\views/api-demo.blade.php ENDPATH**/ ?>