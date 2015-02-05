<?php

Autoloader::namespaces(array(
	'Captcha' => Bundle::path('captcha')
));

IoC::register('Captcha', function()
{
	return new Captcha\Captcha;
});