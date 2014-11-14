Feature: Testing the Login feature

  Scenario: Throws an error when tries to login with an Usuario that does not exist
    Given that I want to make a new "Login"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    When I request "/login"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "true"
    Then the response status code should be 404

  Scenario: Throws an error when tries to login without all the fields
    Given that I want to make a new "Login"
    When I request "/login"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "true"
    Then the response status code should be 400

  Scenario: Login with an Usuario
    Given that I want to make a new "Login"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"
    #Then echo last response

    Given that I want to make a new "Login"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    When I request "/login"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    And the response has a "session" property
    And the response has a "usuario" property
    Then the response status code should be 200

    Given that I want to delete a "Login"
    When I request "/login/{session.key}"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    Then the response status code should be 200