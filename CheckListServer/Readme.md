# CheckListServer
Backend часть задания. Подробнее см. "Docs/Контейнеры.drawio"

Структура:
- Tests - содержит behat(BDD) тесты модели предметной области
- Src - содержит исходный код

## Установка и настройка
Устанавливаем behat

		composer.phar require --dev behat/behat

Устанавливаем phpunit

		composer.phar require --dev phpunit/phpunit
		
## Тесты
Тест кейсы сделаны на основе "Docs/Контексты DDD.drawio"