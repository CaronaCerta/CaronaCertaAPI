Feature: Testing the Motorista

  Scenario: Creating a new Motorista
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Motorista"
    And that its authorization is "{session.key}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    And that its "numero_habilitacao" is "12341345"
    And that its "data_habilitacao" is "1990-01-01"
    When I request "/motorista"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    And the "motorista.id_usuario" property equals "{usuario.id_usuario}"
    And the "motorista.numero_habilitacao" property equals "12341345"
    And the "motorista.data_habilitacao" property equals "1990-01-01"
    Then the response status code should be 201

  Scenario: Editing an Motorista
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Motorista"
    And that its authorization is "{session.key}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    And that its "numero_habilitacao" is "12341345"
    And that its "data_habilitacao" is "1990-01-01"
    When I request "/motorista"

    Given that I want to edit a "Motorista"
    And that its authorization is "{session.key}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    And that its "numero_habilitacao" is "123413456"
    And that its "data_habilitacao" is "1991-01-01"
    When I request "/motorista/{motorista.id_motorista}"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    And the "motorista.id_usuario" property equals "{usuario.id_usuario}"
    And the "motorista.numero_habilitacao" property equals "123413456"
    And the "motorista.data_habilitacao" property equals "1991-01-01"
    Then the response status code should be 200

  Scenario: Deleting an Motorista
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Motorista"
    And that its authorization is "{session.key}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    And that its "numero_habilitacao" is "12341345"
    And that its "data_habilitacao" is "1990-01-01"
    When I request "/motorista"

    Given that I want to delete a "Motorista"
    And that its authorization is "{session.key}"
    When I request "/motorista/{motorista.id_motorista}"
    #Then echo last response
    Then the response is JSON
    And the response has a "error" property
    And the "error" property equals "false"
    Then the response status code should be 200
