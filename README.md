# SocialMedia App

## Overview
SocialMedia is a dynamic social networking application that allows users to connect and interact through features like commenting, liking, following, chatting, posting, and secure login/signup

## Features
- **Commenting**: Users can comment on posts and engage in discussions.
- **Likes**: Users can like posts to show their appreciation.
- **Follow**: Users can follow each other to stay updated with their activities.
- **Chat**: Real-time messaging functionality to communicate with other users.
- **Posts**: Users can create, edit, and delete their posts.
- **Login/Signup**: Secure user authentication for signing up and logging in.
- **Email Verification**

## Technologies Used
- **Backend**: Laravel
- **Database**: MySQL
- **Real-time Functionality**: laravel-websockets
- **Email-Service**: Mailtrap

## How To Use it
**1.** Make sure Everything Matchs With Your `IP Address` in (`.env`,`broadcasting.php`...etc)  
  
**2.** Run `php artisan migrate` for migrating the tables into your Database  
  
**3.** Start The Server  `php artisan serve` or You can specify the host and port...`php artisan serve --host=192.168.1.2 --port=8000`  
  
**4.** Start The Broadcast `php artisan websockets:serve`  


## API Endpoints
Here are the available API endpoints:

### User Authentication
- **Login**: `POST /api/v1/login`
- **Signup**: `POST /api/v1/signup`
- **Logout**: `GET /api/v1/logout`
- **CheckTokens**: `POST /api/v1/tki`

### User Management
- **Get User Details**: `GET /api/v1/user` ***(Token Required)***
- **Update Profile**: `POST /api/v1/user/update`  ***(Token Required)***
- **Search Users**: `GET /api/v1/user/search/{query}`  ***(Token Required)***

### Posts
- **Create Post**: `POST /api/v1/post/create`  ***(Token Required)***
- **Delete Post**: `DELETE /api/v1/post/delete/{postId}`  ***(Token Required)***
- **Update Post**: `PUT /api/v1/post/update/{postId}`  ***(Token Required)***
- **Get Post by ID**: `GET /api/v1/post/{postId}`  ***(Token Required)***
- **Get All Posts**: `GET /api/v1/posts`  ***(Token Required)***
- **Get Posts by User ID**: `GET /api/v1/posts/{userId}`  ***(Token Required)***

### Comments
- **Comment on Post**: `POST /api/v1/comment/{postId}` ***(Token Required)***
- **Delete Comment**: `DELETE /api/v1/comment/{commentId}` ***(Token Required)***
- **Show Comments for Post**: `GET /api/v1/comment/{postId}` ***(Token Required)***

### Likes
- **Like Post**: `POST /api/v1/like/{postId}` ***(Token Required)***
- **Unlike Post**: `DELETE /api/v1/like/{postId}` ***(Token Required)***

### Follow
- **Follow User**: `POST /api/v1/follow/{userId}` ***(Token Required)***
- **Unfollow User**: `DELETE /api/v1/unfollow/{userId}` ***(Token Required)***
- **Get Followers**: `GET /api/v1/followers` ***(Token Required)***
- **Get Followings**: `GET /api/v1/followings` ***(Token Required)***

### Chat
- **Get Messages**: `GET /api/v1/chat` ***(Token Required)***
- **Send Message**: `POST /api/v1/chat` ***(Token Required)***

### Notifications
- **Get Notifications**: `GET /api/v1/notification` ***(Token Required)***
- **Count Unread Notifications**: `GET /api/v1/notification/count` ***(Token Required)***
- **Mark Notifications as Seen**: `GET /api/v1/notification/seen` ***(Token Required)***

### Email Verification
- **Verify Email**: `GET /api/v1/verify/{VerificationCode}` ***(Token Required)*** 
- **Resend Verification Email**: `POST /api/v1/resend` ***(Token Required)*** `Resend Email Verification For Current User` 
- **Verify Email for Test**: `GET /api/v1/verify` ***(Token Required)***  `Verifying current user for test instantly`
