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
            "type": "Array",
            "field": "result",
            "optional": false,
            "description": "with session and usuario."
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/controllers/LoginController.php"
  }
] });