<?php namespace Captcha;

use Intervention\Image\Image;
use Laravel\Config;
use Laravel\Bundle;
use Laravel\Str;
use Laravel\Session;

class Captcha {

	protected $width;

	protected $height;

	protected $count;

	protected $angle;

	protected $fonts;

	protected $fontColors;

	protected $fontSizes;

	protected $backgroundColors;

	protected $isNumbers;

	protected $isLetters;

	protected $isUpper;

	protected $blockWidth;

	protected $value;

	public function __construct()
	{
		$this->width = Config::get('captcha::options.width');

		$this->height = Config::get('captcha::options.height');

		$this->count = Config::get('captcha::options.count');

		$this->angle = Config::get('captcha::options.angle');

		$this->fonts = Config::get('captcha::options.fonts');

		$this->fontColors = Config::get('captcha::options.font_colors');

		$this->fontSize = Config::get('captcha::options.font_size');

		$this->backgroundColors = Config::get('captcha::options.background_colors');

		$this->isNumbers = Config::get('captcha::options.is_numbers');

		$this->isLetters = Config::get('captcha::options.is_letters');

		$this->isUpper = Config::get('captcha::options.is_upper');

		$this->blockWidth = round($this->width / $this->count);
	}

	public function make()
	{
		$image = Image::canvas($this->width, $this->height, $this->random('backgroundColors'));

		for ($i = 0; $i < $this->count; $i++) 
		{
			$symbol = $this->random('symbol');

			$file = Bundle::path('captcha').'fonts'.DS.$this->random('fonts');

			$size = $this->random('fontSize');

			$color = $this->random('fontColors');

			$angle = $this->random('angle');

			$xFrom = round(($i * $this->blockWidth) + ($size / 2));

			$xTo = round(($i * $this->blockWidth) - ($size / 2) + $this->blockWidth);

			$x = rand($xFrom, $xTo);

			$yFrom = round($size / 2);

			$yTo = round($this->height - ($size / 2));

			$y = rand($yFrom, $yTo);

			$image->text($symbol, $x, $y, function($font) use ($file, $size, $color, $angle) 
			{
			    $font->file($file);

			    $font->size($size);

			    $font->color($color);

			    $font->angle($angle);

			    $font->align('center');

			    $font->valign('center');
			});

			$this->value .= $symbol;
		}

		Session::put('captcha', md5(Str::lower($this->value)));

		return $image->encode('png');
	}

	public function check($value)
	{
		if (Session::get('captcha') == md5(Str::lower($value)))
		{
			return true;
		}

		return false;
	}

	protected function random($property)
	{
		if (isset($this->$property) and is_array($this->$property))
		{
			$count = count($this->$property) - 1;

			$rand = rand(0, $count);

			return $this->{$property}[$rand];
		}
		elseif ($property == 'angle')
		{
			return rand((-1 * $this->angle), $this->angle);
		}
		elseif ($property == 'symbol') 
		{
			if ($this->isLetters and $this->isNumbers)
			{
				return $this->isUpper ? Str::upper(Str::random(1, 'alnum')) : Str::random(1, 'alnum');
			}
			elseif ($this->isLetters and !$this->isNumbers) 
			{
				return $this->isUpper ? Str::upper(Str::random(1, 'alpha')) : Str::random(1, 'alpha');
			}
			elseif (!$this->isLetters and $this->isNumbers) 
			{
				return rand(0, 9);
			}

			return Str::random(1, 'alnum');
		}
	}

}