# Captcha
Simple and flexible captcha bundle for Laravel 3

Instalation
-----------
This bundle is using [**Intervention Image v1**](http://image-v1.intervention.io/) library.
Require it via Composer like this:

    "require" : {
    	"intervention/image": "1.*"
    }

Copy Captcha folder to you bundles directory.
Register Captcha bundle like this:

    'captcha' => array('auto' => true)

**Done!**

Usage
-----
Create captcha image and input like this:

    <img src="{{ route('captcha') }}">
    <input type="text" name="captcha">
    
Check  requested captcha on backend like this:

    IoC::resolve('Captcha')->check(Input::get('captcha'))

**That's all!**

Configuration
-------------

See [options](https://github.com/qwertukg/Captcha/blob/master/captcha/config/options.php) :)

**Good luck!**
