import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class TeacherService {
  baseUrl = environment.apiUrl;

  constructor(private http: HttpClient) { }

  getSubjects(): any {
    return this.http.get(this.baseUrl + 'teacher/subjects');
  }

  getClasses(subjectName: string): any {
    return this.http.get(this.baseUrl + `teacher/subject=${subjectName}/classes`);
  }

}
