# CheckListServer
Backend часть задания. Подробнее см. "Docs/Контейнеры.drawio"

Структура:
- Tests - содержит behat(BDD) тесты модели предметной области
- Src - содержит исходный код
- остальные папки сгенерированы Laravel

Примечание

Можно было бы совместить backend и frontend, Laravel это позволяет, но такое смешение создаёт жесткую связь, что в дальнейшем будет мешать тестированию, масштабированию и модификации. Поэтому Laravel используется для backend, Express для frontend. 
Кроме того для frontend-разработки используется именно js и на нем разработаны Vue и React, так как js может напрямую работать с DOM(возможно, дело не в этом, а за год службы в армии могло многое измениться)

## Установка и настройка
Устанавливаем behat

		composer.phar require --dev behat/behat

Устанавливаем phpunit

		composer.phar require --dev phpunit/phpunit
		
Создаём базу данных "checkListApplication" в PostgreSQL, так как проект работает со своей базой данных. Настройки соединения можно изменить в "Src/DomainModel/UniversalContext/DatabaseManager.php"
		
## Тесты
Тест кейсы сделаны на основе "Docs/Контексты DDD.drawio"

## Запуск
Мой код находится в "Src", код обрабатывающий запросы в "routes/web.php".
Сервер запускается командой:
		
		php artisan serve