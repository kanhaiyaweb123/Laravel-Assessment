# Laravel API Project

## Features
- REST API for posts
- Pagination (10 per page)
- API Auth using Laravel Sanctum
- Email notifications on new post (Event + Listener + Mail)

## Setup Instructions
1. Clone the repo
2. Run `composer install`
3. Set `.env` and DB
4. Run `php artisan migrate --seed`
5. Run `php artisan serve`
6. Access: `/api/posts` with token

## API Auth
- Register/Login to get token
- Use in headers: `Authorization: Bearer <token>`
