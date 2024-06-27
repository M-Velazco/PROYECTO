import 'package:flutter/material.dart';
import 'dart:math';
import 'package:http/http.dart' as http;

//  Importa el paquete HTTP para realizar solicitudes HTTP

class Recuperar extends StatefulWidget {
  const Recuperar({super.key});

  @override
  State<Recuperar> createState() => _RecuperarState();
}

class _RecuperarState extends State<Recuperar> with SingleTickerProviderStateMixin {
  late AnimationController _controller;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(seconds: 12), // Ajustar duración más larga si es necesario
    )..repeat(reverse: true);
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  double getRandomOffset(double maxOffset) {
    return Random().nextDouble() * maxOffset * (Random().nextBool() ? 1 : -1);
  }

  Future<void> enviarCorreoRecuperacion(String email) async {
    // Endpoint de tu API PHP para enviar correo de recuperación
    const String url = 'http://tu_servidor/api/enviar_correo_recuperacion.php';

    // Realiza una solicitud HTTP POST al servidor PHP
    try {
      final response = await http.post(Uri.parse(url), body: {'email': email});

      if (response.statusCode == 200) {
        // Éxito al enviar correo
        print('Correo enviado correctamente');
        // Muestra un diálogo o notificación de éxito en Flutter
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: const Text('Éxito'),
            content: const Text('Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.'),
            actions: <Widget>[
              TextButton(
                child: const Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          ),
        );
      } else {
        // Error al enviar correo
        print('Error al enviar correo: ${response.body}');
        // Muestra un diálogo o notificación de error en Flutter
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: const Text('Error'),
            content: const Text('No se pudo enviar el correo electrónico. Por favor, intenta de nuevo más tarde.'),
            actions: <Widget>[
              TextButton(
                child: const Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          ),
        );
      }
    } catch (e) {
      // Error de conexión
      print('Error de conexión: $e');
      // Muestra un diálogo o notificación de error en Flutter
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: const Text('Error'),
          content: const Text('Error de conexión. Por favor, verifica tu conexión a internet.'),
          actions: <Widget>[
            TextButton(
              child: const Text('OK'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [Color(0xFF33D6FF), Color(0xFF3F8BEE)],
          ),
        ),
        child: Stack(
          children: [
            AnimatedBuilder(
              animation: _controller,
              builder: (context, child) {
                return Stack(
                  children: [
                    Positioned(
                      top: 150 + getRandomOffset(20),
                      left: 20 + getRandomOffset(2),
                      child: _buildAnimatedSquare(100, Colors.white.withOpacity(0.1)),
                    ),
                    Positioned(
                      top: 250 + getRandomOffset(2),
                      right: 150 + getRandomOffset(2),
                      child: _buildAnimatedSquare(80, Colors.white.withOpacity(0.1)),
                    ),
                    Positioned(
                      bottom: 150 + getRandomOffset(2),
                      left: 200 + getRandomOffset(2),
                      child: _buildAnimatedSquare(60, Colors.white.withOpacity(0.1)),
                    ),
                    Positioned(
                      bottom: 250 + getRandomOffset(20),
                      right: 150 + getRandomOffset(20),
                      child: _buildAnimatedSquare(120, Colors.white.withOpacity(0.1)),
                    ),
                  ],
                );
              },
            ),
            Center(
              child: SingleChildScrollView(
                child: Container(
                  width: 400,
                  padding: const EdgeInsets.all(32.0),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(16.0),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.1),
                        blurRadius: 10,
                        spreadRadius: 5,
                      ),
                    ],
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Text(
                        'Recuperar contraseña',
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 24,
                          fontWeight: FontWeight.w600,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 8),
                      Container(
                        width: 80,
                        height: 4,
                        color: Colors.white,
                      ),
                      const SizedBox(height: 40),
                      Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 16.0),
                        child: TextField(
                          decoration: InputDecoration(
                            filled: true,
                            fillColor: Colors.white.withOpacity(0.3),
                            hintText: "Correo electrónico",
                            labelText: "Correo electrónico",
                            labelStyle: const TextStyle(
                              color: Colors.white,
                            ),
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(35),
                              borderSide: BorderSide.none,
                            ),
                            contentPadding: const EdgeInsets.symmetric(
                              horizontal: 20,
                              vertical: 16,
                            ),
                            focusedBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(35),
                              borderSide: const BorderSide(
                                color: Color(0xFF1745DD),
                              ),
                            ),
                          ),
                          style: const TextStyle(
                            color: Colors.white,
                            fontSize: 16,
                            fontFamily: 'Poppins',
                            fontStyle: FontStyle.italic,
                          ),
                          onChanged: (value) {
                            // Puedes almacenar el valor del campo de texto si es necesario
                          },
                        ),
                      ),
                      const SizedBox(height: 20),
                      ElevatedButton(
                        onPressed: () {
                          // Llama a la función para enviar correo de recuperación
                          enviarCorreoRecuperacion('correo_ejemplo@example.com');
                        },
                        style: ElevatedButton.styleFrom(
                          foregroundColor: Colors.white,
                          backgroundColor: const Color(0xFF70DB0C),
                          padding: const EdgeInsets.symmetric(
                            horizontal: 50,
                            vertical: 15,
                          ),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(35),
                          ),
                        ),
                        child: const Text(
                          'Enviar',
                          style: TextStyle(
                            fontFamily: 'Poppins',
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ),
                      const SizedBox(height: 20),
                      InkWell(
                        onTap: () {
                          // Handle navigation to login screen
                        },
                        child: const Text(
                          '¿Ya tienes una cuenta? Iniciar sesión',
                          style: TextStyle(
                            color: Colors.white,
                            fontFamily: 'Poppins',
                            fontWeight: FontWeight.w600,
                            decoration: TextDecoration.underline,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildAnimatedSquare(double size, Color color) {
    return AnimatedBuilder(
      animation: _controller,
      builder: (context, child) {
        return Transform.translate(
          offset: Offset(
            getRandomOffset(10) * sin(_controller.value * 2 * pi),
            getRandomOffset(10) * cos(_controller.value * 2 * pi),
          ),
          child: Container(
            width: size,
            height: size,
            decoration: BoxDecoration(
              color: color,
              borderRadius: BorderRadius.circular(16.0),
            ),
          ),
        );
      },
    );
  }
}
