<?php

namespace Wjxcodes\Express;


/**
* laravel集成
*/
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
	
	protected $defer = true;

	public function register() {

		$this->app->singleton(Express::class, function(){
			return new Express(config('services.express.appkey')); 
		});

		$this->app->alias(Express::class, 'express'); 

	}

	public function provides()
	{
		return [Express::class,'express'];
	}

}