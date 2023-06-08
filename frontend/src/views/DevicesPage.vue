<template>
  <v-card>
    <v-toolbar>
      <v-toolbar-title>Список IT оборудования сотрудников</v-toolbar-title>
      <v-spacer />
    </v-toolbar>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field label="Введите сетевое имя устройства"></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-data-table :headers="headers">
        <template #no-data>
          <p>Разрешения отсутсвуют...</p>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    headers: [
      { text: 'ФИО', value: 'fullName', sortable: false, width: 100 },
      { text: 'Модель', align: 'model', value: 'modelDevice', sortable: false, width: 200 },
      { text: 'Сетевое имя', value: 'networkName', width: 150 },
      { text: 'Инвентарный номер', value: 'inventoryNumber', sortable: false, width: 150 },
      { text: 'Серийный номер', value: 'serialNumber', sortable: false, width: 600 }
    ]
  })
}
</script>
