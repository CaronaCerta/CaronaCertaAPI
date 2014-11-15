define({ api: [
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
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/controllers/UsuarioController.php"
  }
] });