1) git clone https://github.com/Div-Man/images-tests.git
2) Скопировать файл .env из другого проекта и изменить для него данные
3) Проверить, что установлена версия PHP 7 (php -v), желательно php 7.2
4) composer update
5) php artisan migrate
6) Зарегистрировать одного пользователья в ручную 
7) Выполнить тесты, я это делаю командой .\vendor\bin\phpunit --bootstrap vendor\autoload.php --testdox tests
