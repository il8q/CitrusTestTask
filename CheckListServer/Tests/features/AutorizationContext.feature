Feature: Autorization context
  Container "Чек-лист сервер" => Component "Ядро бизнес-логики"
	
  Scenario: Guest can register and become a user
    Given e-mail "guestTest@gmail.com" and password "passwordTest1"
    When e-mail not found in User list
    Then create User with e-mail and password
    And add to User list
    And guest transfer to "Start page"

  Scenario: Guest can autorizate and transfer to "Main page"
    Given e-mail "guestTest@gmail.com" and password "passwordTest1"
    When e-mail found
    And password equal password from User list
    Then guest stand User
    And User transfer to "Start page"