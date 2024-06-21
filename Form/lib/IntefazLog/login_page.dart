import 'package:flutter/material.dart';
import 'package:flutter_application_1/IntefazLog/register_page.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();

  bool _isLoginFormVisible = true;

  void _login() {
    if (_formKey.currentState!.validate()) {
      // Lógica para enviar las credenciales al backend
      String email = _emailController.text;
      String password = _passwordController.text;
      // Implementar lógica de autenticación
    }
  }

  void _register() {
    setState(() {
      _isLoginFormVisible = false;
    });

    // Esperar un breve momento antes de redirigir a la página de registro
    Future.delayed(const Duration(milliseconds: 720), () {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => RegisterPage()),
      );
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(),
      body: Stack(
        children: [
          AnimatedPositioned(
            duration: const Duration(milliseconds: 800),
            curve: Curves.easeInOut,
            left: _isLoginFormVisible ? -700 : 1000,
            top: _isLoginFormVisible ? -200 : 200,
            child: Container(
              width: _isLoginFormVisible ? 1900 : 1900,
              height: _isLoginFormVisible ? 900 : 900,
              decoration: const BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.green,
              ),
              child: Stack(
                alignment: Alignment.center,
                children: [
                  Positioned(
                    bottom: 500,
                    right: 700,
                    child: TextButton(
                      onPressed: _register,
                      child: const Text(
                        '¿No tienes una cuenta? Regístrate',
                        style: TextStyle(color: Colors.white),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
          Positioned(
            bottom: 200,
            right: 100,
            left: 300,
            child: Visibility(
              visible: _isLoginFormVisible,
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 560.0),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Text(
                      'Iniciar sesión',
                      style: TextStyle(fontSize: 24),
                    ),
                    const SizedBox(height: 300),
                    Form(
                      key: _formKey,
                      child: Column(
                        children: [
                          TextFormField(
                            controller: _emailController,
                            decoration: const InputDecoration(
                              labelText: 'Correo Electrónico',
                              prefixIcon: Icon(Icons.email),
                            ),
                            keyboardType: TextInputType.emailAddress,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Por favor ingrese su correo electrónico';
                              }
                              return null;
                            },
                          ),
                          const SizedBox(height: 20),
                          TextFormField(
                            controller: _passwordController,
                            decoration: const InputDecoration(
                              labelText: 'Contraseña',
                              prefixIcon: Icon(Icons.lock),
                            ),
                            obscureText: true,
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Por favor ingrese su contraseña';
                              }
                              return null;
                            },
                          ),
                          const SizedBox(height: 20),
                          ElevatedButton(
                            onPressed: _login,
                            child: const Text('Ingresar'),
                          ),
                          TextButton(
                            onPressed: () {
                              // Redirigir al usuario a la página de restablecimiento de contraseña
                            },
                            child: const Text('Olvidé mi contraseña'),
                          ),
                        ],
                      ),
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
