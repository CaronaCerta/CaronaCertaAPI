Feature: Testing the Atributo

  Scenario: Creating a new Atributo
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Atributo"
    And that its authorization is "{session.key}"
    And that its "nome" is "test"
    When I request "/atributo"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the "atributo.nome" property equals "test"
    Then the response status code should be 201

  Scenario: Editing an Atributo
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Atributo"
    And that its authorization is "{session.key}"
    And that its "nome" is "test"
    When I request "/atributo"

    Given that I want to edit a "Atributo"
    And that its authorization is "{session.key}"
    And that its "nome" is "test2"
    When I request "/atributo/{atributo.id_atributo}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the "atributo.nome" property equals "test2"
    Then the response status code should be 200

  Scenario: Deleting an Atributo
    Given that I want to make a new "Usuario"
    And that its "email" is "test@test.com"
    And that its "senha" is "test"
    And that its "nome" is "test"
    And that its "data_nascimento" is "1990-01-01"
    And that its "telefone" is "3333-3333"
    And that its "endereco" is "test"
    And that its "cidade" is "test"
    When I request "/usuario"

    Given that I want to make a new "Atributo"
    And that its authorization is "{session.key}"
    And that its "nome" is "test"
    When I request "/atributo"

    Given that I want to delete a "Atributo"
    And that its authorization is "{session.key}"
    When I request "/atributo/{atributo.id_atributo}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    Then the response status code should be 200

