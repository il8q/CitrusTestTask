Feature: PresentCheckList context
  Container "Чек-лист сервер" => Component "Ядро бизнес-логики"
	
  Scenario: User open "Main page" and see "Check list"s
    When "Main page" is opening
    Then send "Check list"s in short form
    And in the form content "id", "title", "description"

  Scenario: User unwrap check "Check list"
    Given check list id="0"
    Then send points from check list