const express = require('express');
const { createProxyMiddleware } = require('http-proxy-middleware');

const app = express();
const port = 3307; // Puerto en el que se ejecutará el servidor

// Configura el proxy para redirigir solicitudes a form.php
app.use('/form.php', createProxyMiddleware({
  target: 'http://localhost/PROYECTO/DIGIWORM..04',
  changeOrigin: true,
  pathRewrite: {
    '^/form.php': '/form.php', // Reescribe la ruta para que coincida con la ruta del backend PHP
  },
}));

// Rutas de ejemplo
app.get('/', (req, res) => {
  res.send('¡Hola desde el servidor!');
});

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
