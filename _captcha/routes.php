<?php

Route::get('captcha', array('as' => 'captcha', function()
{
	return IoC::resolve('Captcha')->make();
}));