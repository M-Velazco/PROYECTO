import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_core/firebase_core.dart';

class DatabaseService {
  final FirebaseFirestore_db = FirebaseFirestore.instance;

  // Método para agregar un usuario a Firestore
  Future<void> addUser(String userId, String email, String firstName,
      String lastName, String phone) async {
    try {
      await _Digiworm_04.collection('users').doc(userId).set({
        'email': email,
        'firstName': firstName,
        'lastName': lastName,
        'phone': phone,
      });
    } catch (e) {
      print('Error adding user to Firestore: $e');
      throw DatabaseException('Error adding user to Firestore: $e');
    }
  }

  // Método para obtener información de un usuario desde Firestore
  Future<Map<String, dynamic>?> getUser(String userId) async {
    try {
      DocumentSnapshot doc =
          await _Digiworm_04.collection('users').doc(userId).get();
      if (doc.exists) {
        return doc.data() as Map<String, dynamic>;
      } else {
        return null;
      }
    } catch (e) {
      print('Error fetching user from Firestore: $e');
      throw DatabaseException('Error fetching user from Firestore: $e');
    }
  }
}

class DatabaseException implements Exception {
  final String message;

  DatabaseException(this.message);

  @override
  String toString() {
    return 'DatabaseException: $message';
  }
}
