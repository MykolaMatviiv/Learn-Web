import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
//import { enableProdMode } from '@angular/core';

//enableProdMode{}; //Uncoment for production
import { AppModule } from './app.module';

platformBrowserDynamic().bootstrapModule(AppModule);