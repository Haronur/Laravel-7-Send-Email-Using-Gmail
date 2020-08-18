<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Laravel 7 Send Email Example


#### Step 1: Make Configuration

In first step, you have to add send mail configuration with mail driver, mail host, mail port, mail username, mail password so laravel 7 will use those sender details on email. So you can simply add as like following.

 - .env

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=haronurr@gmail.com
MAIL_PASSWORD=password of haronurr@gmail.com Account
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=haronurr@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Step 2: Create Mail

In this step we will create mail class SendMail for email sending. Here we will write code for which view will call and object of user. So let's run bellow command.

```
 php artisan make:mail SendMail
```

 - app/Mail/SendMail.php

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Subject: Test Email From Artisan Sorftware Valley')
                    ->view('emails.sendmail');
    }
}
```
#### Step 3: Create Controller

In this step we will create Controller class EmailController for email sending. Here we will write code for which view will call and object of user. So let's run bellow command.

```
 php artisan make:controller EmailController
```

 - App/Http/Controllers/EmailController.php

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;

class EmailController extends Controller
{
    public function send_email()
    {
     $details = [
        'title' => 'Title: Artisan Sorftware Valley',
        'body' => 'Body: This is for testing email using smtp'
    ];
   
    \Mail::to('haronur@gmail.com')->send(new SendMail($details));
   	return view('emails.thanks');
    }
}
```

#### Step 4: Create Blade View

In this step, we will create blade view file and write email that we want to send. now we just write some dummy text. create bellow files on "emails" folder.

- resources/views/emails/sendmail.blade.php
```
<!DOCTYPE html>
<html>
<head>
    <title>Artisan Sorftware Valley</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>Thank you</p>
</body>
</html>
```
- resources/views/emails/thanks.blade.php
```
<!DOCTYPE html>
<html>
<head>
	<title>Thanks</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="alert alert-success" role="alert">
		 	Thanks, we will contact you soon
		</div>
	 </div>
</body>
</html>
```

#### Step 5: Add Route

Now at last we will create "SendMail" for sending our test email. so let's create bellow web route for testing send email.
```
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send', 'EmailController@send_email')->name('send_email');
```
Now you can run and check example.

It will send you email, let' see.

#### Run Project:
```
php artisan serve
```
#### Open Link:

http://localhost:8000/send-mail

### Gmail Security Turn Off First if You want to send from your local PC

