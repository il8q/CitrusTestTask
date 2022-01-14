Feature: PresentCheckList context
  Container "Чек-лист сервер" => Component "Ядро бизнес-логики"
	
  Scenario: User open "Main page" and see "Check list"s
    When "Main page" is opening
    Then send "Check list"s in short form
    And in the form content "title", "description", "id"

  Scenario: User unwrap check "Check list"
    Given "id" from "Check list"
    Then send "point"s from "Check list"