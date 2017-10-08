import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import {UserComponent} from "./user/user.component";
import {HttpModule} from "@angular/http";
import {HoverDirective} from "./hover.directive";

@NgModule({
  declarations: [
    AppComponent,
    UserComponent,
    HoverDirective
  ],
  imports: [
    BrowserModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
