@echo off

cd /d C:\Users\muham\OneDrive\Desktop\KurdGram\GitHub-Pc\SocialMedia
php artisan queue:work --sleep=3 --tries=3
