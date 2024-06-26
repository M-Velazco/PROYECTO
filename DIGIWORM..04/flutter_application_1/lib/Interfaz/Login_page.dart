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

  void _login() async {
    if (_formKey.currentState!.validate()) {
      String email = _emailController.text.trim();
      String password = _passwordController.text.trim();
      try {
        final response = await http.post(
          Uri.parse('http://localhost/PROYECTO/DIGIWORM..04/index.html'), // Reemplaza con tu URL correcta
          headers: <String, String>{
            'Content-Type': 'application/json; charset=UTF-8',
          },
          body: jsonEncode(<String, String>{
            'email': email,
            'password': password,
          }),
        );
        if (response.statusCode == 200) {
          // Usuario autenticado, manejar la respuesta según necesites
          print('Inicio de sesión exitoso');
          // Aquí podrías manejar el token de sesión u otra lógica
        } else {
          // Error de inicio de sesión, muestra un mensaje
          print('Credenciales incorrectas');
        }
      } catch (e) {
        print('Error de inicio de sesión: $e');
      }
    }
  }

  @override
  void initState() {
    super.initState();
    // Inicializar WebView si es necesario (requiere que webview_flutter esté configurado correctamente)
    // WebView.platform = SurfaceAndroidWebView();
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    bool isSmallScreen = size.width < 600;

    return Scaffold(
      appBar: AppBar(title: Text('Inicio de Sesión')),
      body: Column(
        children: [
          
          Padding(
            padding: EdgeInsets.all(20.0),
            child: SizedBox(
              width: isSmallScreen ? size.width * 0.9 : size.width * 0.5,
              child: Form(
                key: _formKey,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    TextFormField(
                      controller: _emailController,
                      decoration: InputDecoration(
                        labelText: 'Correo Electrónico',
                        prefixIcon: Icon(Icons.email),
                      ),
                      keyboardType: TextInputType.emailAddress,
                      validator: (value) {
                        if (value == null || value.trim().isEmpty) {
                          return 'Por favor ingrese su correo electrónico';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 20),
                    TextFormField(
                      controller: _passwordController,
                      decoration: InputDecoration(
                        labelText: 'Contraseña',
                        prefixIcon: Icon(Icons.lock),
                      ),
                      obscureText: true,
                      validator: (value) {
                        if (value == null || value.trim().isEmpty) {
                          return 'Por favor ingrese su contraseña';
                        }
                        return null;
                      },
                    ),
                    SizedBox(height: 20),
                    ElevatedButton(
                      onPressed: _login,
                      child: Text('Ingresar'),
                    ),
                    TextButton(
                      onPressed: () {
                        // Implementar lógica para restablecer contraseña
                      },
                      child: Text('Olvidé mi contraseña'),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
