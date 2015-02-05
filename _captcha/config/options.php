<?php

return array(

	// Width of captcha image.
	'width' => 100, 

	// Height of captcha image.
	'height' => 40, 

	// Number of letters in captcha.
	'count' => 5, 

	// Maximum angle of symbol rotation, within negative value.
	'angle' => 45, 

	// Font filename, geting from Captcha/fonts folder.
	'fonts' => array(
		'default_1.ttf',
		'default_2.ttf',
		'default_3.ttf',
		'default_4.ttf',
		'default_5.ttf',
	),

	// List of availble font colors.
	'font_colors' => array(
		'#222',
		'#333',
		'#444',
		'#666',
		'#888',
	),

	// List of availble font sizes.
	'font_size' => array(
		16,
		18,
		20,
		22,
		24,
	),

	// List of availble background colors.
	'background_colors' => array(
		'#FFF',
	),

	// If is true then captcha has numeric letters.
	'is_numbers' => true,

	// If is true then captcha has alpha letters.
	'is_letters' => false,

	// If is true then all captcha letters is in uppercase.
	'is_upper' => true,

);