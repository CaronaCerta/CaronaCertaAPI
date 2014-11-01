Feature: Testing the Usuario

  Scenario: Creating a new Usuario
    Given that I want to make a new "Usuario"
    And that its "email" is "%str_rand@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    And the response has a "session" property
    And the response has a "usuario.email" property
    And the "usuario.nome" property equals "test"
    Then the response status code should be 201