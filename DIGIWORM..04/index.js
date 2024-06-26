const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3306;

app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
  host: 'localhost',
  user: 'tu_usuario',
  password: 'sena',
  database: 'digiworm_04'
});

db.connect(err => {
  if (err) {
    console.error('Error conectando a la base de datos:', err);
    return;
  }
  console.log('Conectado a la base de datos MySQL');
});

// Ruta para el registro de usuarios
app.post('/register', (req, res) => {
  const { id, firstName, lastName, email, phone, password } = req.body;
  const query = 'INSERT INTO usuarios (id, firstName, lastName, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)';
  db.query(query, [id, firstName, lastName, email, phone, password], (err, results) => {
    if (err) {
      console.error('Error al registrar usuario:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
    } else {
      res.status(201).json({ message: 'Usuario registrado exitosamente' });
    }
  });
});

// Ruta para el inicio de sesión
app.post('/login', (req, res) => {
  const { email, password } = req.body;
  const query = 'SELECT * FROM usuarios WHERE email = ? AND password = ?';
  db.query(query, [email, password], (err, results) => {
    if (err) {
      console.error('Error al intentar iniciar sesión:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
    } else if (results.length > 0) {
      res.status(200).json({ message: 'Inicio de sesión exitoso' });
    } else {
      res.status(401).json({ message: 'Credenciales incorrectas' });
    }
  });
});

app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});
