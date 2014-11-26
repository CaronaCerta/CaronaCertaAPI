Feature: Testing the Passageiro

  Scenario: Creating a new Passageiro
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

    Given that I want to make a new "Carona"
    And that its authorization is "{session.key}"
    And that its "id_carro" is "{carro.id_carro}"
    And that its "data" is "1990-01-01"
    And that its "lugar_saida" is "test1"
    And that its "lugar_destino" is "test2"
    And that its "lugares_disponiveis" is "3"
    And that its "observacoes" is "test3"
    When I request "/carona"

    Given that I want to make a new "Passageiro"
    And that its authorization is "{session.key}"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    When I request "/passageiro"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    Then the response status code should be 201

  Scenario: Editing a Passageiro
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

    Given that I want to make a new "Carona"
    And that its authorization is "{session.key}"
    And that its "id_carro" is "{carro.id_carro}"
    And that its "data" is "1990-01-01"
    And that its "lugar_saida" is "test1"
    And that its "lugar_destino" is "test2"
    And that its "lugares_disponiveis" is "3"
    And that its "observacoes" is "test3"
    When I request "/carona"

    Given that I want to make a new "Passageiro"
    And that its authorization is "{session.key}"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    When I request "/passageiro"

    Given that I want to edit a "Passageiro"
    And that its authorization is "{session.key}"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    When I request "/passageiro/{passageiro.id_passageiro}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    Then the response status code should be 200

  Scenario: Deleting a Carona
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

    Given that I want to make a new "Carona"
    And that its authorization is "{session.key}"
    And that its "id_carro" is "{carro.id_carro}"
    And that its "data" is "1990-01-01"
    And that its "lugar_saida" is "test1"
    And that its "lugar_destino" is "test2"
    And that its "lugares_disponiveis" is "3"
    And that its "observacoes" is "test3"
    When I request "/carona"

    Given that I want to make a new "Passageiro"
    And that its authorization is "{session.key}"
    And that its "id_carona" is "{carona.id_carona}"
    And that its "id_usuario" is "{usuario.id_usuario}"
    When I request "/passageiro"

    Given that I want to delete a "Passageiro"
    And that its authorization is "{session.key}"
    When I request "/passageiro/{passageiro.id_passageiro}"
    #Then echo last response
    Then the response is JSON
    And the "error" property equals "false"
    Then the response status code should be 200
