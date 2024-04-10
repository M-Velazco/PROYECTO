<!DOCTYPE html>
<html>
<head>
  <title>Swagger UI</title>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist/swagger-ui.css">
</head>
<body>
  <div id="swagger-ui"></div>

  <script src="https://unpkg.com/swagger-ui-dist/swagger-ui-bundle.js"></script>
  <script>
    window.onload = function() {
      // Configura Swagger UI con la URL de tu documento de especificación de Swagger
      const ui = SwaggerUIBundle({
        url: "http://localhost/PROYECTO/DIGIWORM..04/Apis/Docentes.json",
        dom_id: '#swagger-ui',
        deepLinking: true,
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIBundle.SwaggerUIStandalonePreset
        ]
      })

      window.ui = ui
    }
  </script>
</body>
</html>
