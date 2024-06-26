import 'package:flutter/material.dart';
import 'package:flutter_application_1/Interfaz/Login_page.dart'; // Asegúrate de importar tu página de inicio de sesión
import 'package:http/http.dart' as http; // Importa el paquete http para hacer llamadas HTTP

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: "Inicio Sesión",
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const LoginPage(),
    );
  }
}
