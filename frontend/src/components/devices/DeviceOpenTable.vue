<template>
  <v-card-text>
    <v-container>
      <v-row>
        <v-col cols="1" md="3">
          <v-text-field label="Введите сетевое имя устройства"></v-text-field>
        </v-col>
      </v-row>
    </v-container>
    <v-data-table :headers="headers" :items="items">
      <template #[`item.access`]="{ item }">
        <v-chip class="ma-2" :color="item.approval === true ? 'green' : 'red'" text-color="black" outlined>
          {{ item.approval === true ? 'Разрешено' : 'Не разрешено' }}
        </v-chip>
      </template>
      <template #[`item.approval`]="{ item }">
        <v-checkbox v-model="item.approval" color="success" hide-details> </v-checkbox>
      </template>
      <template #no-data>
        <p>Разрешения отсутсвуют...</p>
      </template>
    </v-data-table>
  </v-card-text>
</template>
