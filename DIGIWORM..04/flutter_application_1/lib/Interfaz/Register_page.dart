import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class RegisterPage extends StatefulWidget {
  final bool isLoginFormVisible;

  const RegisterPage({Key? key, required this.isLoginFormVisible})
      : super(key: key);

  @override
  _RegisterPageState createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  final TextEditingController _idController = TextEditingController();
  final TextEditingController _firstNameController = TextEditingController();
  final TextEditingController _lastNameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _phoneController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  void _register() async {
    if (_formKey.currentState!.validate()) {
      String id = _idController.text.trim();
      String firstName = _firstNameController.text.trim();
      String lastName = _lastNameController.text.trim();
      String email = _emailController.text.trim();
      String phone = _phoneController.text.trim();
      String password = _passwordController.text.trim();

      try {
        final response = await http.post(
          Uri.parse('http://localhost:3000/register'),
          headers: <String, String>{
            'Content-Type': 'application/json; charset=UTF-8',
          },
          body: jsonEncode(<String, String>{
            'id': id,
            'firstName': firstName,
            'lastName': lastName,
            'email': email,
            'phone': phone,
            'password': password,
          }),
        );

        if (response.statusCode == 201) {
          // Registro exitoso
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('Registro exitoso'),
              duration: Duration(seconds: 2),
            ),
          );
          // Puedes navegar a la pantalla de inicio de sesión u otra pantalla aquí
        } else {
          // Error en el registro
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text('Error al registrar'),
              duration: Duration(seconds: 4),
            ),
          );
        }
      } catch (e) {
        print('Error de conexión: $e');
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error de conexión'),
            duration: Duration(seconds: 4),
          ),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;

    return Scaffold(
      body: Stack(
        children: [
          AnimatedPositioned(
            duration: const Duration(milliseconds: 500),
            curve: Curves.easeInOut,
            right: widget.isLoginFormVisible ? -size.width * 2.2 : -1000,
            top: size.height * 0.5,
            child: Container(
              width: size.width * 1.2,
              height: size.height * 2.36,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.green,
              ),
              child: Stack(
                alignment: Alignment.centerRight,
                children: [
                  FloatingActionButton(
                    onPressed: () {
                      // Acción cuando se presiona el botón de Loguéate
                    },
                    child: const Text('Loguéate'),
                  ),
                ],
              ),
            ),
          ),
          Positioned(
            right: 0,
            left: 0,
            child: Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(16.0),
                child: Container(
                  width: size.width < 600 ? size.width * 0.9 : size.width * 0.5,
                  constraints: const BoxConstraints(maxWidth: 600),
                  padding: const EdgeInsets.all(16.0),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(8.0),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.1),
                        blurRadius: 10,
                        offset: const Offset(0, 5),
                      ),
                    ],
                  ),
                  child: Form(
                    key: _formKey,
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            IconButton(
                              icon: Icon(Icons.arrow_back),
                              onPressed: () {
                                Navigator.pop(context); // Regresar a la pantalla anterior
                              },
                            ),
                            const Spacer(),
                            const Text(
                              'Registrarse',
                              style: TextStyle(fontSize: 24),
                            ),
                            const Spacer(),
                            SizedBox(
                              width: 48,
                            ), // Ajuste de espacio para alinear correctamente
                          ],
                        ),
                        const SizedBox(height: 20),
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
                            if (value.length != 10) {
                              return 'Debe tener 10 dígitos';
                            }
                            return null;
                          },
                        ),
                        const SizedBox(height: 20),
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
                        const SizedBox(height: 20),
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
                        const SizedBox(height: 20),
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
                            if (!RegExp(
                                    r"^[a-zA-Z0-9._%+-]+@(gmail\.com|outlook\.com|hotmail\.com)$")
                                .hasMatch(value)) {
                              return 'Por favor ingrese un correo válido';
                            }
                            return null;
                          },
                        ),
                        const SizedBox(height: 20),
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
                            if (value.length != 10) {
                              return 'Debe tener 10 dígitos';
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
                            if (value.length < 8 ||
                                !RegExp(r'^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$')
                                    .hasMatch(value)) {
                              return 'La contraseña debe tener al menos 8 caracteres y contener números, letras y signos especiales';
                            }
                            return null;
                          },
                        ),
                        const SizedBox(height: 20),
                        ElevatedButton(
                          onPressed: _register,
                          child: const Text('Registro completo'),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
          Positioned(
            left: size.width * 0.15,
            top: size.height * 0.45,
            child: Visibility(
              visible: widget.isLoginFormVisible,
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
