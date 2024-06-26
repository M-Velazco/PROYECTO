import 'package:firebase_auth/firebase_auth.dart';
import 'package:flutter/material.dart';
import 'package:flutter_application_1/Interfaz/Register_page.dart';
import 'package:flutter_application_1/Interfaz/auth_service.dart';
import 'package:http/http.dart' as http;

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key});
  
  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _formKey = GlobalKey<FormState>();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  final AuthService _authService = AuthService();


  bool _isLoginFormVisible = true;

  void _login() async {
    if (_formKey.currentState!.validate()) {
      String email = _emailController.text.trim();
      String password = _passwordController.text.trim();
      try {
        UserCredential userCredential =
            await FirebaseAuth.instance.signInWithEmailAndPassword(
          email: email,
          password: password,
        );
        // Usuario autenticado, puedes navegar a la pantalla principal o realizar otras acciones
      } catch (e) {
        // Error de inicio de sesión, muestra un mensaje al usuario
        print('Error de inicio de sesión: $e');
        // Aquí puedes mostrar un mensaje de error en tu UI
      }
    }
  }

  void _register() {
    setState(() {
      _isLoginFormVisible = false;
    });

    // Esperar un breve momento antes de redirigir a la página de registro
    Future.delayed(const Duration(milliseconds: 800), () {
      Navigator.push(
        context,
        MaterialPageRoute(
            builder: (context) => RegisterPage(isLoginFormVisible: false)),
      ).then((_) {
        setState(() {
          _isLoginFormVisible = true;
        });
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    bool isSmallScreen = size.width < 600;

    return Scaffold(
      appBar: AppBar(),
      body: Stack(
        children: [
          AnimatedPositioned(
            duration: const Duration(milliseconds: 800),
            curve: Curves.easeInOut,
            left: _isLoginFormVisible ? -size.width : size.width,
            top: _isLoginFormVisible ? -size.height * 0.2 : size.height * 0.2,
            child: Container(
              width: size.width * 2,
              height: size.height * 2,
              decoration: const BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.green,
              ),
              child: Stack(
                alignment: Alignment.center,
                children: [
                  Positioned(
                    bottom: size.height * 0.3,
                    right: size.width * 0.5,
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
          Align(
            alignment:
                isSmallScreen ? Alignment.topCenter : Alignment.centerRight,
            child: Visibility(
              visible: _isLoginFormVisible,
              child: Padding(
                padding: EdgeInsets.only(
                  right: isSmallScreen ? 0 : size.width * 0.1,
                  top: isSmallScreen ? size.height * 0.1 : 0,
                ),
                child: SizedBox(
                  width: isSmallScreen ? size.width * 0.9 : size.width * 0.3,
                  child: Column(
                    mainAxisAlignment: isSmallScreen
                        ? MainAxisAlignment.start
                        : MainAxisAlignment.center,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      const Text(
                        'Iniciar sesión',
                        style: TextStyle(fontSize: 24),
                      ),
                      const SizedBox(height: 20),
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
                                if (value == null || value.trim().isEmpty) {
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
                                if (value == null || value.trim().isEmpty) {
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
                                // Implementar lógica para restablecer contraseña
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
          ),
          Positioned(
            left: size.width * 0.15,
            top: size.height * 0.45,
            child: Visibility(
              visible: _isLoginFormVisible,
              child: FloatingActionButton.extended(
                onPressed: _register,
                label: const Text('Regístrate'),
                icon: const Icon(Icons.person_add),
                backgroundColor: Colors.white,
                foregroundColor: Colors.green,
              ),
            ),
          ),
        ],
      ),
    );
  }
}



