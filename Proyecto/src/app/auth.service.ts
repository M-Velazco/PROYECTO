// auth.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private baseUrl = 'https://your-api-url/';

  constructor(private http: HttpClient) {}

  login(credentials: any) {
    // Implement login logic using HttpClient
    return this.http.post(`${this.baseUrl}login`, credentials);
  }

  register(user: any) {
    // Implement registration logic using HttpClient
    return this.http.post(`${this.baseUrl}register`, user);
  }
}
