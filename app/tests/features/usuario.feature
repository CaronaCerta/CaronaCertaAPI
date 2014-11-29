Feature: Testing the Usuario

  Scenario: Creating a new Usuario
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the response has a "session" property
    And the "usuario.email" property equals "test@test.com"
    And the "usuario.nome" property equals "test"
    And the "usuario.data_nascimento" property equals "1990-01-01"
    And the "usuario.telefone" property equals "3333-3333"
    And the "usuario.endereco" property equals "test"
    And the "usuario.cidade" property equals "test"
    Then the response status code should be 201

    Given that I want to find a "Usuario"
    And that its authorization is "{session.key}"
    When I request "/usuario/me"
    Then echo last response

  Scenario: Editing an Usuario
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to edit a "Usuario"
    And that its authorization is "{session.key}"
    And that its "email" is "test2@test.com"
    And that its "senha" is "test2"
    And that its "nome" is "test2"
    And that its "data_nascimento" is "1990-01-02"
    And that its "telefone" is "3333-3334"
    And that its "endereco" is "test2"
    And that its "cidade" is "test2"
    When I request "/usuario/{usuario.id_usuario}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the "usuario.email" property equals "test2@test.com"
    And the "usuario.nome" property equals "test2"
    And the "usuario.data_nascimento" property equals "1990-01-02"
    And the "usuario.telefone" property equals "3333-3334"
    And the "usuario.endereco" property equals "test2"
    And the "usuario.cidade" property equals "test2"
    Then the response status code should be 200

  Scenario: Deleting an Usuario
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to delete a "Usuario"
    And that its authorization is "{session.key}"
    When I request "/usuario/{usuario.id_usuario}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    Then the response status code should be 200

