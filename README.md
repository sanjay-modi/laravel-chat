## laravel 8 chat application

### Requirement as below:
- Coding Challenge: Design a messaging system using Laravel 8. The system should be able to view, send, receive, and delete messages between various users. Restrictions on this you should use tailwind css for any css styling. Use blade templates and partials to their full effect. Also follow DRY and KISS principles.

- Deliverables:
Git repo including instructions on how to install and run the application in a README file.

- Additional notes:
The test is intentionally not pre-scaffolded to test that you are comfortable setting up and packing a solution.
Completing the project is important and is for us to see your own coding style, we are not looking for a carbon copy of an existing solution.

### Follow installation steps:

Fire commands in terminal : 
#####  Step : 1

```
git clone https://github.com/sanjay-modi/laravel-chat.git
```
##### Step : 2

```
cd  chat-demo
```
##### Step 3

```
cp .env.example .env
```
Create db on your system and update database details in .env file
##### Step : 4

```
composer install
```

##### Step : 5
```
php artisan migrate
php artisan migrate --seed

```
- This will generate tables in db and some random dummy users to check app
- You can use any email to login from users table.
- All user's password is "password".


##### Step : 6
```
php artisan serve
npm install
```

##### Step : 7
```
php artisan websockets:serve
```
- Please run this in new command terminal (websockets)
