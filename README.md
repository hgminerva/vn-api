## Laravel API Template

### How to install
```bash
composer install
php artisan key:generate
```

### Template available API routes
```
POST /api/login    # Login guest user, this accepts email and password
POST /api/logout   # Logout the currently authenticated user
GET /api/auth      # Get the authenticated user information
GET /api/users     # Fetches the list of available users
```

> To identify if user is authenticated, API consumer should pass the "`Authorization: Bearer <token>`" in the header.

### How to run test case
```bash
php artisan test
```

> Template has 4 successful test case

```bash
   PASS  Tests\Feature\AuthControllerTest
  ✓ it should get authenticated user information

   PASS  Tests\Feature\LoginControllerTest
  ✓ it should login user

   PASS  Tests\Feature\LogoutControllerTest
  ✓ it should logout user

   PASS  Tests\Feature\UserControllerTest
  ✓ it should get list of users
```
