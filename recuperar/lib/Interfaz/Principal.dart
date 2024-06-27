import 'package:flutter/material.dart';
import 'package:recuperar/Interfaz/HomePrincipal.dart';

class Principal extends StatelessWidget {
  const Principal({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      title: "Recuperar",
      debugShowCheckedModeBanner: false,
      home: Recuperar(),
    );
  }
}
