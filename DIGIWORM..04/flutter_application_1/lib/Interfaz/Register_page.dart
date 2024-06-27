import 'package:flutter/material.dart';
import 'package:flutter_application_1/Interfaz/Login_page.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class RegisterPage extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();
  final _idController = TextEditingController();
  final _firstNameController = TextEditingController();
  final _lastNameController = TextEditingController();
  final _emailController = TextEditingController();
  final _phoneController = TextEditingController();
  final _passwordController = TextEditingController();

  RegisterPage({Key? key}) : super(key: key);

  Future<void> _register(BuildContext context) async {
    if (_formKey.currentState!.validate()) {
      String id = _idController.text.trim();
      String firstName = _firstNameController.text.trim();
      String lastName = _lastNameController.text.trim();
      String email = _emailController.text.trim();
      String phone = _phoneController.text.trim();
      String password = _passwordController.text.trim();

      var body = jsonEncode({
        'id': id,
        'firstName': firstName,
        'lastName': lastName,
        'email': email,
        'phone': phone,
        'password': password,
      });

      var url = Uri.parse('http://localhost/your_project/register.php');

      try {
        var response = await http.post(
          url,
          headers: {
            'Content-Type': 'application/json',
          },
          body: body,
        );

        if (response.statusCode == 201) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('Registro exitoso'),
              backgroundColor: Colors.green,
            ),
          );

          Navigator.pushReplacementNamed(context, '/login');
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('Error al registrar'),
              backgroundColor: Colors.red,
            ),
          );
        }
      } catch (e) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Error de conexión'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  void loginRedirect(BuildContext context) {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => const LoginPage()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Positioned(
            top: -250,
            right: -250,
            child: Container(
              width: 1000,
              height: 1300,
              decoration: BoxDecoration(
                color: const Color.fromARGB(255, 74, 230, 80),
                shape: BoxShape.circle,
              ),
              child: Padding(
                padding: EdgeInsets.only(
                  right: 100,
                  bottom: 100,
                ),
                child: Align(
                  alignment: Alignment.bottomRight,
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        '¿Tiene usted una cuenta?',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: 22,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 15),
                      const Text(
                        'Debe iniciar sesión para conocer más de nosotros..',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: 16,
                        ),
                      ),
                      const SizedBox(height: 10),
                      ElevatedButton(
                        onPressed: () {
                          loginRedirect(context);
                        },
                        style: ElevatedButton.styleFrom(
                          foregroundColor: Colors.black,
                          backgroundColor: Colors.white,
                        ),
                        child: const Text(
                          'INGRESAR',
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
          Center(
            child: Container(
              width: MediaQuery.of(context).size.width * 0.50,
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 40),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(30),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey.withOpacity(0.5),
                    spreadRadius: 2,
                    blurRadius: 5,
                    offset: const Offset(0, 3),
                  ),
                ],
              ),
              child: SingleChildScrollView(
                child: Form(
                  key: _formKey,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: <Widget>[
                      Center(
                        child: const Text(
                          'Registrarse',
                          style: TextStyle(
                            fontSize: 33,
                            fontStyle: FontStyle.italic,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                      const SizedBox(height: 20.0),
                      TextFormField(
                        controller: _idController,
                        decoration: const InputDecoration(
                          labelText: 'Número Identificación',
                          prefixIcon: Icon(Icons.perm_identity),
                        ),
                        keyboardType: TextInputType.number,
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Por favor ingrese su número de identificación';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 20.0),
                      TextFormField(
                        controller: _firstNameController,
                        decoration: const InputDecoration(
                          labelText: 'Nombres',
                          prefixIcon: Icon(Icons.person),
                        ),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Por favor ingrese sus nombres';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 20.0),
                      TextFormField(
                        controller: _lastNameController,
                        decoration: const InputDecoration(
                          labelText: 'Apellidos',
                          prefixIcon: Icon(Icons.person),
                        ),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Por favor ingrese sus apellidos';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 20.0),
                      TextFormField(
                        controller: _emailController,
                        decoration: const InputDecoration(
                          labelText: 'Correo electrónico',
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
                      const SizedBox(height: 20.0),
                      TextFormField(
                        controller: _phoneController,
                        decoration: const InputDecoration(
                          labelText: 'Teléfono',
                          prefixIcon: Icon(Icons.phone),
                        ),
                        keyboardType: TextInputType.phone,
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Por favor ingrese su teléfono';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 20.0),
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
                          } else if (value.length < 8) {
                            return 'La contraseña debe tener al menos 8 caracteres';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 20.0),
                      ElevatedButton(
                        onPressed: () => _register(context),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color.fromARGB(255, 61, 232, 67),
                          padding: const EdgeInsets.symmetric(vertical: 15),
                        ),
                        child: const Center(child: Text('REGISTRARSE')),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}