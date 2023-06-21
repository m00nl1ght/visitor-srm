<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
    </v-toolbar>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="1" md="3">
            <v-text-field label="Введите сетевое имя устройства"></v-text-field>
          </v-col>
          <v-col cols="1" md="7">
            <v-btn :disabled="disabled" outlined x-large color="success">Новое разрешение</v-btn>
          </v-col>
          <v-col cols="1" md="1">
            <v-btn :disabled="disabled"  x-large color="primary">Все разрешения</v-btn>
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
  </v-card>
</template>

<script>
export default {
  data: function () {
    return {
      headers: [
        { text: 'Разрешение', value: 'access', sortable: false, width: 100 },
        { text: 'ФИО', value: 'fullName', sortable: false, width: 100 },
        { text: 'Модель', value: 'model', sortable: false, width: 200 },
        { text: 'Сетевое имя', value: 'networkName', width: 150 },
        { text: 'Инвентарный номер', value: 'inventoryNumber', sortable: false, width: 150 },
        { text: 'Серийный номер', value: 'serialNumber', sortable: false, width: 600 },
        { text: 'Подтверждено', value: 'approval', sortable: false }
      ],
      items: [
        {
          access: 'Разрешено',
          fullName: 'Иванов Иван Иванович',
          model: 'T14',
          networkName: 'N1111111',
          inventoryNumber: '1111',
          serialNumber: 'q1q1q1q1',
          approval: true
        },
        {
          access: 'Не разрешено',
          fullName: 'Петров Петр Петрович',
          model: 'T14',
          networkName: 'N1111111',
          inventoryNumber: '1111',
          serialNumber: 'q1q1q1q1',
          approval: false
        },
        {
          access: 'Разрешено',
          fullName: 'Сидоров Сидор Сидорович',
          model: 'T14',
          networkName: 'N1111111',
          inventoryNumber: '1111',
          serialNumber: 'q1q1q1q1',
          approval: true
        },
        {
          access: 'не Разрешено',
          fullName: 'Васильев Василий Васильевич',
          model: 'T14',
          networkName: 'N1111111',
          inventoryNumber: '1111',
          serialNumber: 'q1q1q1q1',
          approval: false
        }
      ]
    }
  }
}
</script>
