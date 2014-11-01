Feature: Testing the Login feature

  Scenario: Login in with a user Usuario
    Given that I want to make a new "Login"
    And that its "email" is "tocha@tocha.com"
    And that its "senha" is "test"
    When I request "/login"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    And the response has a "session" property
    And the response has a "usuario" property
    Then the response status code should be 200