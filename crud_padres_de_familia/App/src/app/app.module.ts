import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
 selector: 'app-root',
 templateUrl: './app.component.html',
 styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
 data: any;

 constructor(private http: HttpClient) { }

 ngOnInit() {
    this.http.get('https://jsonplaceholder.typicode.com/posts/1').subscribe(response => {
      console.log(response);
      this.data = response;
    }, error => {
      console.log(error);
    });
 }
}
