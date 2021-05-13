import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { TeacherService } from 'src/app/_services/teacher.service';
import { ToastrService } from 'ngx-toastr';
import { StudentActivity } from 'src/app/_models/_teacher/activity/student-activity';
import { StudentActivityObj } from 'src/app/_models/_teacher/activity/student-activity-obj';

@Component({
  selector: 'app-activity-list',
  templateUrl: './activity-list.component.html',
  styleUrls: ['./activity-list.component.css']
})
export class ActivityListComponent implements OnInit {
  readOnly = false;
  date = '';

  // list which is getting from api to display
  list: StudentActivity[] = [];

  constructor(
    private teacherService: TeacherService,
    private route: ActivatedRoute,
    private toastr: ToastrService) {}

  ngOnInit(): void {
    this.teacherService
    .getStudentsActivity(this.route.snapshot.paramMap.get('class') || '')
      .subscribe((res: StudentActivityObj) => {
        this.readOnly = res.readOnly;
        this.date = res.date;
        this.list = res.StudentActivity;
      });
  }

  saveList(): void {
    const subject = this.teacherService.delDashesAndUpperFirstLetter(
      this.route.snapshot.paramMap.get('subject') || '');

    this.teacherService.sendPresentList(subject, this.list).subscribe(
      () => this.toastr.success('Obecność została zarejestrowana'));
  }
}
