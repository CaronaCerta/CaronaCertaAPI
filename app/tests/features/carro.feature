Feature: Testing the Carro

  Scenario: Creating a new Carro
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

    Given that I want to make a new "Carro"
    And that its authorization is "{session.key}"
    And that its "modelo" is "test1"
    And that its "descricao" is "test2"
    And that its "id_motorista" is "{motorista.id_motorista}"
    When I request "/carro"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the "carro.modelo" property equals "test1"
    And the "carro.descricao" property equals "test2"
    And the "carro.id_motorista" property equals "{motorista.id_motorista}"
    Then the response status code should be 201

  Scenario: Editing a Carro
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

    Given that I want to make a new "Carro"
    And that its authorization is "{session.key}"
    And that its "modelo" is "test1"
    And that its "descricao" is "test2"
    And that its "id_motorista" is "{motorista.id_motorista}"
    When I request "/carro"

    Given that I want to edit a "Carro"
    And that its authorization is "{session.key}"
    And that its "modelo" is "test3"
    And that its "descricao" is "test4"
    And that its "id_motorista" is "{motorista.id_motorista}"
    When I request "/carro/{carro.id_carro}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And the "usuario.modelo" property equals "test3"
    And the "usuario.descricao" property equals "test4"
    And the "usuario.id_motorista" property equals "{motorista.id_motorista}"
    Then the response status code should be 200

  Scenario: Deleting a Carro
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

    Given that I want to make a new "Carro"
    And that its authorization is "{session.key}"
    And that its "modelo" is "test1"
    And that its "descricao" is "test2"
    And that its "id_motorista" is "{motorista.id_motorista}"
    When I request "/carro"

    Given that I want to delete a "Carro"
    And that its authorization is "{session.key}"
    When I request "/carro/{carro.id_carro}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    Then the response status code should be 200
