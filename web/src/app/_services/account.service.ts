import { Injectable } from '@angular/core';
import { ReplaySubject } from 'rxjs';
import { environment } from 'src/environments/environment';
import { User } from '../_models/user';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { RecivedUser } from '../_models/recivedUser';
import { Dictionary } from '../_models/dictionary';

@Injectable({
  providedIn: 'root'
})
export class AccountService {
  private currentUserSource = new ReplaySubject<User | null>(1);
  currentUser$ = this.currentUserSource.asObservable();
  baseUrl = environment.apiUrl;

  roles: Dictionary<string> = {
    teacher: '/nauczyciel',
    student: '/uczen'
  };

  constructor(private http: HttpClient) { }

  login(model: any): any {
    return this.http.post(this.baseUrl + 'logowanie', model).pipe(
      map((res) => {
        const user = res as User;
        console.log(user);
        // recived date are other than User interface, so this date
        // have themself interface
        // const recivedUser = res as RecivedUser;
        // const role = [recivedUser?.role[0]?.status.toLowerCase()];

        // const user: User = {
        //   identifier: recivedUser?.message?.identifier,
        //   name: recivedUser?.message?.first_name.toLowerCase(),
        //   lastName: recivedUser?.message?.last_name.toLowerCase(),
        //   roles: role
        // };

        this.setCurrentUser(user);
      })
    );
  }

  setCurrentUser(user: User | null): void {
    localStorage.setItem('user', JSON.stringify(user));
    this.currentUserSource.next(user);
  }

  logout(): void {
    localStorage.removeItem('user');
    this.currentUserSource.next(null);
  }
}
