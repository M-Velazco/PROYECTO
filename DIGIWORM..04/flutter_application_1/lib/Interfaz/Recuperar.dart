import 'package:flutter/material.dart';
import 'dart:math';

import 'package:flutter_application_1/Interfaz/Login_page.dart';

class Recuperar extends StatefulWidget {
  const Recuperar({super.key});

  @override
  State<Recuperar> createState() => _RecuperarState();
}

class _RecuperarState extends State<Recuperar>
    with SingleTickerProviderStateMixin {
  late AnimationController _controller;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(seconds: 12), // Ajustar duración más larga
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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [Color.fromARGB(255, 123, 218, 242), Color(0xFF3F8BEE)],
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
                      child: _buildAnimatedSquare(
                          100, const Color.fromARGB(255, 2, 2, 2).withOpacity(0.1)),
                    ),
                    Positioned(
                      top: 250 + getRandomOffset(2),
                      right: 150 + getRandomOffset(2),
                      child: _buildAnimatedSquare(
                          80, const Color.fromARGB(255, 0, 0, 0).withOpacity(0.1)),
                    ),
                    Positioned(
                      bottom: 150 + getRandomOffset(2),
                      left: 200 + getRandomOffset(2),
                      child: _buildAnimatedSquare(
                          60, const Color.fromARGB(255, 0, 0, 0).withOpacity(0.1)),
                    ),
                    Positioned(
                      bottom: 250 + getRandomOffset(20),
                      right: 150 + getRandomOffset(20),
                      child: _buildAnimatedSquare(
                          120, const Color.fromARGB(255, 0, 0, 0).withOpacity(0.1)),
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
                    color: const Color.fromARGB(255, 0, 0, 0).withOpacity(0.1),
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
                          color: Color.fromARGB(255, 0, 0, 0),
                        ),
                      ),
                      const SizedBox(height: 8),
                      Container(
                        width: 80,
                        height: 4,
                        color: const Color.fromARGB(255, 0, 0, 0),
                      ),
                      const SizedBox(height: 40),
                      Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 16.0),
                        child: TextField(
                          decoration: InputDecoration(
                            filled: true,
                            fillColor: Color.fromARGB(255, 0, 0, 0).withOpacity(0.3),
                            hintText: "Correo electrónico",
                            labelText: "Correo electrónico",
                            labelStyle: const TextStyle(
                              color: Color.fromARGB(255, 255, 250, 250),
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
                            color: Color.fromARGB(255, 0, 0, 0),
                            fontSize: 16,
                            fontFamily: 'Poppins',
                            fontStyle: FontStyle.italic,
                          ),
                        ),
                      ),
                      const SizedBox(height: 20),
                      ElevatedButton(
                        onPressed: () {
                          // Handle password reset logic here
                        },
                        style: ElevatedButton.styleFrom(
                          foregroundColor: const Color.fromARGB(255, 0, 0, 0),
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
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => const LoginPage()),
                          );
                        },
                        child: const Text(
                          '¿Ya tienes una cuenta? Iniciar sesión',
                          style: TextStyle(
                            color: Color.fromARGB(255, 0, 0, 0),
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
