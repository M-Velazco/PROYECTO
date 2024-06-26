const express = require('express');
const app = express();
const port = 3306; // Puerto en el que se ejecutará el servidor

// Rutas de ejemplo
app.get('/', (req, res) => {
  res.send('¡Hola desde el servidor!');
});

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
