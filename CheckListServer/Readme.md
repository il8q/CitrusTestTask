# CheckListServer
Backend ����� �������. ��������� ��. "Docs/����������.drawio"

���������:
- Tests - �������� behat(BDD) ����� ������ ���������� �������
- Src - �������� �������� ���
- ��������� ����� ������������� Laravel

����������

����� ���� �� ���������� backend � frontend, Laravel ��� ���������, �� ����� �������� ������ ������� �����, ��� � ���������� ����� ������ ������������, ��������������� � �����������. ������� Laravel ������������ ��� backend, Express ��� frontend. 
����� ���� ��� frontend-���������� ������������ ������ js � �� ��� ����������� Vue � React, ��� ��� js ����� �������� �������� � DOM(��������, ���� �� � ����, � �� ��� ������ � ����� ����� ������ ����������)

## ��������� � ���������
������������� behat

		composer.phar require --dev behat/behat

������������� phpunit

		composer.phar require --dev phpunit/phpunit
		
������ ���� ������ "checkListApplication" � PostgreSQL, ��� ��� ������ �������� �� ����� ����� ������. ��������� ���������� ����� �������� � "Src/DomainModel/UniversalContext/DatabaseManager.php"
		
## �����
���� ����� ������� �� ������ "Docs/��������� DDD.drawio"

## ������
��� ��� ��������� � "Src", ��� �������������� ������� � "routes/web.php".
������ ����������� ��������:
		
		php artisan serve