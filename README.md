First run to install the dependencies
```
composer install
```
To run the unit test, go to the root folder and run
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/OrderProcessingTests
```
To view the summary of the week report, first go to the root folder and run
```
php -S 127.0.0.1:8080
```
Then go to the link
[127.0.0.1:8080/index.php](127.0.0.1:8080/index.php)