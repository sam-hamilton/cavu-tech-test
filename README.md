<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# CAVU Technical Task
## API Endpoints
- Get availability - (GET) */api/availability?from=2023-01-25&to=2023-02-07*
- Create booking - (POST) */api/bookings?from=2023-01-25&to=2023-01-30&vehicle_registration=ABC 123&payment_method=PayPal*
- Delete booking - (DELETE) */api/bookings/2*
- Edit booking - (PATCH)  */api/bookings/1?vehicle_registration=XYZ 789*
- Show booking - (GET) */api/bookings/1*
- List bookings - (GET) */api/bookings*
## Notes
- You can use `php artisan db:seed` to run some basic seeders
- The API will stop you booking a reservation if there is no availability
- The API will choose the cheapest price based on the duration of their reservation
- You can only edit the vehicle registration, a user would have to cancel their booking and create a new one if they wanted to change the date
- The API has not been versioned for this task (i.e. v1)
- No authorisation is required for to access the API
