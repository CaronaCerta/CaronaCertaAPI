define({ api: [
  {
    "type": "put",
    "url": "/carro/:id",
    "title": "Carro Alter",
    "name": "AlterCarro",
    "group": "Carro",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the carro"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "modelo",
            "optional": false,
            "description": "The modelo of the carro"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "descricao",
            "optional": false,
            "description": "The descricao of the carro"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "id_motorista",
            "optional": false,
            "description": "The ID of the motorista"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "carro",
            "optional": false,
            "description": "with carro object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Registro alterado com sucesso\"\n        \"carro\": {\n            \"id_carro\": \"5\",\n            \"modelo\": \"Test\",\n            \"descricao\": \"test\",\n            \"id_motorista\": 20,\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse carro nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/CarroController.php"
  },
  {
    "type": "delete",
    "url": "/carro/:id",
    "title": "Carro Delete",
    "name": "DeleteCarro",
    "group": "Carro",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the carro"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Carro deletado com sucesso\"\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Ocorreu um erro ao tentar remover o carro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse carro nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/CarroController.php"
  },
  {
    "type": "get",
    "url": "/carro/:id",
    "title": "Carro Get",
    "name": "GetCarro",
    "group": "Carro",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the carro"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "carro",
            "optional": false,
            "description": "with the carro object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Carro obtido com sucesso\"\n        \"carro\": {\n            \"id_carro\": \"5\",\n            \"modelo\": \"Test\",\n            \"descricao\": \"test\",\n            \"id_motorista\": \"20\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar o carro\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/CarroController.php"
  },
  {
    "type": "get",
    "url": "/carro",
    "title": "Carro List",
    "name": "GetCarros",
    "group": "Carro",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "carros",
            "optional": false,
            "description": "with a list of carros object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Listagem feita com sucesso\"\n        \"carros\": [{\n            \"id_carro\": \"5\",\n            \"modelo\": \"Test\",\n            \"descricao\": \"test\",\n            \"id_motorista\": \"20\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        },\n        {\n            \"id_carro\": \"5\",\n            \"modelo\": \"Test\",\n            \"descricao\": \"test\",\n            \"id_motorista\": \"20\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }]\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar os carros\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/CarroController.php"
  },
  {
    "type": "post",
    "url": "/carro",
    "title": "Carro Register",
    "name": "NewCarro",
    "group": "Carro",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "modelo",
            "optional": false,
            "description": "The modelo of the carro"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "descricao",
            "optional": false,
            "description": "The descricao of the carro"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "id_motorista",
            "optional": false,
            "description": "The ID of the motorista"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "carro",
            "optional": false,
            "description": "with carro object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 201 Created\n    {\n        \"error\": false,\n        \"message\": \"Registro feito com sucesso\"\n        \"carro\": {\n            \"id_carro\": \"5\",\n            \"modelo\": \"Test\",\n            \"descricao\": \"test\",\n            \"id_motorista\": \"20\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 200 OK\n   {\n     \"error\": true,\n     \"message\": \"Campo obrigatório modelo, descricao e id_motorista faltando ou vazio\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/CarroController.php"
  },
  {
    "type": "get",
    "url": "/login",
    "title": "User Login",
    "name": "Login",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "email",
            "optional": false,
            "description": "Email do usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "senha",
            "optional": false,
            "description": "Senha do usuario"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "session",
            "optional": false,
            "description": "with session object."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "usuario",
            "optional": false,
            "description": "with usuario object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"session\": {\n            \"key\": \"52940b45d3a70139e0e45221e7d753c4\",\n            \"id_usuario\": \"5\",\n            \"updated_at\": \"2014-11-14 22:24:16\",\n            \"created_at\": \"2014-11-14 22:24:16\",\n            \"id_session\": 7\n        },\n        \"usuario\": {\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Login falhou. Credenciais incorretas\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/LoginController.php"
  },
  {
    "type": "delete",
    "url": "/login/:key",
    "title": "User Logout",
    "name": "Logout",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "key",
            "optional": false,
            "description": "The session key"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Logout feito com sucesso\"\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n    {\n        \"error\": true,\n        \"message\": \"Sessão não contrada\"\n    }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/LoginController.php"
  },
  {
    "type": "put",
    "url": "/motorista/:id",
    "title": "Motorista Alter",
    "name": "AlterMotorista",
    "group": "Motorista",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the motorista"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "id_usuario",
            "optional": false,
            "description": "The id of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "numero_habilitacao",
            "optional": false,
            "description": "The numero de hatilitação of the motorista"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "data_habilitacao",
            "optional": false,
            "description": "The data de habilitacao of the motorista"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "motorista",
            "optional": false,
            "description": "with motorista object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Registro alterado com sucesso\"\n        \"motorista\": {\n            \"id_motorista\": \"5\",\n            \"id_usuario\": \"5\",\n            \"numero_habilitacao\": \"123445671234\",\n            \"data_habilitacao\": \"2014-11-14 00:00:00\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse motorista nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/MotoristaController.php"
  },
  {
    "type": "delete",
    "url": "/motorista/:id",
    "title": "Motorista Delete",
    "name": "DeleteMotorista",
    "group": "Motorista",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the motorista"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Motorista deletado com sucesso\"\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Ocorreu um erro ao tentar remover o motorista\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse motorista nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/MotoristaController.php"
  },
  {
    "type": "get",
    "url": "/motorista/:id",
    "title": "Motorista Get",
    "name": "GetMotorista",
    "group": "Motorista",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the motorista"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "motorista",
            "optional": false,
            "description": "with the motorista object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Motorista obtido com sucesso\"\n        \"motorista\": {\n            \"id_motorista\": \"5\",\n            \"numero_habilitacao\": \"123445671234\",\n            \"data_habilitacao\": \"2014-11-14 00:00:00\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar o motorista\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/MotoristaController.php"
  },
  {
    "type": "get",
    "url": "/motorista",
    "title": "Motorista List",
    "name": "GetMotoristas",
    "group": "Motorista",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "motoristas",
            "optional": false,
            "description": "with a list of motoristas object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Listagem feita com sucesso\"\n        \"motoristas\": [{\n            \"id_motorista\": \"5\",\n            \"numero_habilitacao\": \"123445671234\",\n            \"data_habilitacao\": \"2014-11-14 00:00:00\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        },\n        {\n            \"id_motorista\": \"5\",\n            \"numero_habilitacao\": \"123445671234\",\n            \"data_habilitacao\": \"2014-11-14 00:00:00\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }]\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar os motoristas\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/MotoristaController.php"
  },
  {
    "type": "post",
    "url": "/motorista",
    "title": "Motorista Register",
    "name": "NewMotorista",
    "group": "Motorista",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id_usuario",
            "optional": false,
            "description": "The id of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "numero_habilitacao",
            "optional": false,
            "description": "The numero de hatilitação of the motorista"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "data_habilitacao",
            "optional": false,
            "description": "The data de habilitacao of the motorista *"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "motorista",
            "optional": false,
            "description": "with motorista object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 201 Created\n    {\n        \"error\": false,\n        \"message\": \"Registro feito com sucesso\"\n        \"motorista\": {\n            \"id_motorista\": \"5\",\n            \"numero_habilitacao\": \"123445671234\",\n            \"data_habilitacao\": \"2014-11-14 00:00:00\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 200 OK\n   {\n     \"error\": true,\n     \"message\": \"Campo obrigatório id_usuario, numero_habilitacao, data_habilitacao faltando ou vazio\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/MotoristaController.php"
  },
  {
    "type": "put",
    "url": "/usuario/:id",
    "title": "User Alter",
    "name": "AlterUsuario",
    "group": "Usuario",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "email",
            "optional": false,
            "description": "The email of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "senha",
            "optional": false,
            "description": "The senha of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "nome",
            "optional": false,
            "description": "The nome of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "data_nascimento",
            "optional": false,
            "description": "The data de nascimento of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "telefone",
            "optional": false,
            "description": "The telefone of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "endereco",
            "optional": false,
            "description": "The endereço of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "cidade",
            "optional": false,
            "description": "The cidade of the usuario"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "usuario",
            "optional": false,
            "description": "with usuario object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Registro alterado com sucesso\"\n        \"usuario\": {\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse usuario nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  },
  {
    "type": "delete",
    "url": "/usuario/:id",
    "title": "User Delete",
    "name": "DeleteUsuario",
    "group": "Usuario",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the usuario"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Usuario deletado com sucesso\"\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Ocorreu um erro ao tentar remover o usuario\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 404 Not Found\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse usuario nao esta no sistema\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  },
  {
    "type": "get",
    "url": "/usuario/:id",
    "title": "User Get",
    "name": "GetUsuario",
    "group": "Usuario",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "id",
            "optional": false,
            "description": "The id of the usuario"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "usuario",
            "optional": false,
            "description": "with the usuario object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Usuario obtido com sucesso\"\n        \"usuario\": {\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar o usuario\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  },
  {
    "type": "get",
    "url": "/usuario",
    "title": "User List",
    "name": "GetUsuarios",
    "group": "Usuario",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "usuarios",
            "optional": false,
            "description": "with a list of usuarios object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    {\n        \"error\": false,\n        \"message\": \"Listagem feita com sucesso\"\n        \"usuarios\": [{\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        },\n        {\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }]\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Erro ao recuperar os usuarios\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  },
  {
    "type": "post",
    "url": "/usuario",
    "title": "User Register",
    "name": "NewUsuario",
    "group": "Usuario",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "field": "email",
            "optional": false,
            "description": "The email of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "senha",
            "optional": false,
            "description": "The senha of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "nome",
            "optional": false,
            "description": "The nome of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "data_nascimento",
            "optional": false,
            "description": "The data de nascimento of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "telefone",
            "optional": false,
            "description": "The telefone of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "endereco",
            "optional": false,
            "description": "The endereço of the usuario"
          },
          {
            "group": "Parameter",
            "type": "String",
            "field": "cidade",
            "optional": false,
            "description": "The cidade of the usuario"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Success 200",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An success message explaining the result."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "session",
            "optional": false,
            "description": "with session object."
          },
          {
            "group": "Success 200",
            "type": "Array",
            "field": "usuario",
            "optional": false,
            "description": "with usuario object."
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 201 Created\n    {\n        \"error\": false,\n        \"message\": \"Registro feito com sucesso\"\n        \"session\": {\n            \"key\": \"52940b45d3a70139e0e45221e7d753c4\",\n            \"id_usuario\": \"5\",\n            \"updated_at\": \"2014-11-14 22:24:16\",\n            \"created_at\": \"2014-11-14 22:24:16\",\n            \"id_session\": 7\n        },\n        \"usuario\": {\n            \"id_usuario\": \"5\",\n            \"email\": \"test@test.com\",\n            \"nome\": \"test\",\n            \"data_nascimento\": \"1990-10-10\",\n            \"telefone\": \"3333-3333\",\n            \"endereco\": \"test\",\n            \"cidade\": \"test\",\n            \"created_at\": \"2014-11-14 00:00:00\",\n            \"updated_at\": \"2014-11-14 00:00:00\"\n        }\n    }\n"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Boolean",
            "field": "error",
            "optional": false,
            "description": "true when there is an error, and false otherwise."
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "field": "message",
            "optional": false,
            "description": "An error message explaining the error."
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 500 Server Error\n   {\n     \"error\": true,\n     \"message\": \"Oops! Um erro ocorreu durante o registro\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 200 OK\n   {\n     \"error\": true,\n     \"message\": \"Desculpe, esse e-mail ja esta no sistema\"\n   }\n"
        },
        {
          "title": "Error-Response:",
          "content": "   HTTP/1.1 200 OK\n   {\n     \"error\": true,\n     \"message\": \"Campo obrigatório email, senha, nome, data_nascimento, telefone, endereco, cidade faltando ou vazio\"\n   }\n"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  }
] });