import 'package:flutter/material.dart';
import 'package:flutter_application_1/Interfaz/Login_page.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: "Inicio Sesión",
      debugShowCheckedModeBanner: false,
      home: const LoginPage(),
    );
  }
}
