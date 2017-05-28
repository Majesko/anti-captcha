# PHP Library for solving captcha using anti-captcha service (https://anti-captcha.com)
note: for using library you need to be registered in anti-captcha service and have positive balance

#Installation and usage
````
#install library with composer
php composer.phar require majesko/anti-captcha
````
Next init Anti-captcha client with api key from anti-captcha
````
$client = new \AntiCaptcha\Client('enter api key here');
````
Prepare captcha image in base64 format using helper method from url
````
$image = $client->image_url_to_base64('http://url-to-captcha-image');
````
Create new captcha solving task
````
$task = new \AntiCaptcha\Tasks\ImageToTextTask($image);
````
Send task to Anti-captcha
````
$taskResponse = $client->createTask($task);
````
Check captcha status
````
$status = $client->getTaskResult($taskResponse->getTaskId());
````
If captcha was solved (it takes ~30 seconds - depends on settings and difficulty) get solution
````
$solution = $status->getSolution();
$solution->getText(); // this is solved captcha string
````

For more information refer to anti-captcha docs: https://anticaptcha.atlassian.net/wiki/display/API/API+v.2+Documentation