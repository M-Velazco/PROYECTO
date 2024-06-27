import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  Future<void> _login() async {
    if (_formKey.currentState!.validate()) {
      String email = _emailController.text.trim();
      String password = _passwordController.text.trim();

      // Construir el cuerpo de la solicitud POST
      var body = jsonEncode({
        'idUsuario': email,
        'password': password,
      });

      // URL de tu API PHP
      var url = Uri.parse('http://localhost/PROYECTO/DIGIWORM..04/Apis/LoginApis.php');

      try {
        // Realizar la solicitud HTTP POST
        var response = await http.post(
          url,
          headers: {
            'Content-Type': 'application/json',
          },
          body: body,
        );

        // Verificar el código de respuesta
        if (response.statusCode == 200) {
          // Procesar la respuesta JSON
          var jsonResponse = jsonDecode(response.body);
          print(jsonResponse);

          // Ejemplo: Redirigir a otra pantalla después de iniciar sesión exitosamente
          Navigator.pushReplacementNamed(context, '/home');
        } else {
          // Error en la solicitud HTTP
          print('Error: ${response.reasonPhrase}');
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text('Error de inicio de sesión'),
              backgroundColor: Colors.red,
            ),
          );
        }
      } catch (e) {
        // Error de conexión
        print('Error de conexión: $e');
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error de conexión'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Iniciar Sesión'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: <Widget>[
              TextFormField(
                controller: _emailController,
                decoration: InputDecoration(
                  labelText: 'Correo Electrónico',
                ),
                validator: (value) {
                  if (value!.isEmpty) {
                    return 'Por favor ingrese su correo electrónico';
                  }
                  return null;
                },
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: _passwordController,
                decoration: InputDecoration(
                  labelText: 'Contraseña',
                ),
                obscureText: true,
                validator: (value) {
                  if (value!.isEmpty) {
                    return 'Por favor ingrese su contraseña';
                  }
                  return null;
                },
              ),
              SizedBox(height: 20.0),
              ElevatedButton(
                onPressed: _login,
                child: Text('Ingresar'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
