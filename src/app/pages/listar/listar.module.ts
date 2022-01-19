import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ListarPageRoutingModule } from './listar-routing.module';
import { ComponentsModule } from 'src/app/components/components.module';

import { ListarPage } from './listar.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ListarPageRoutingModule,
    ComponentsModule
  ],
  declarations: [ListarPage]
})
export class ListarPageModule {}
