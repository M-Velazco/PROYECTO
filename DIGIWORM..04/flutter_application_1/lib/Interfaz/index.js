const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.json());

// Configurar la conexión a la base de datos
const db = mysql.createConnection({
  host: 'localhost',
  user: 'tu_usuario',
  password: 'sena',
  database: 'digiworm_04'
});

db.connect((err) => {
  if (err) {
    throw err;
  }
  console.log('Conectado a la base de datos MySQL');
});

// Ruta para obtener datos
app.get('/datos', (req, res) => {
  let sql = 'SELECT * FROM tabla';
  db.query(sql, (err, result) => {
    if (err) throw err;
    res.send(result);
  });
});

// Ruta para insertar datos
app.post('/datos', (req, res) => {
  let data = req.body;
  let sql = 'INSERT INTO tabla SET ?';
  db.query(sql, data, (err, result) => {
    if (err) throw err;
    res.send('Dato insertado...');
  });
});

app.listen(port, () => {
  console.log(`Servidor iniciado en el puerto ${port}`);
});
