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
    "url": "/login",
    "title": "User logout",
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
  }
] });