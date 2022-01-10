<template>
  <v-container>
    <v-row align="center">
      <v-col cols="12" sm="6" md="4">
        <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field v-model="date" label="Выберите даты" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
          </template>
          <v-date-picker v-model="date" range color="primary" locale="ru-ru"></v-date-picker>
        </v-menu>
      </v-col>

      <v-col>
        <v-btn color="primary" outlined>Показать отчет</v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <SecurityMainReport :reportData="reportData" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import SecurityMainReport from '@/components/reports/SecurityMainReport.vue'

export default {
  props: {
    reportData: {
      type: Object,
      default: () => {}
    }
  },

  components: {
    SecurityMainReport
  },

  data() {
    return {
      menu: false,
      date: undefined
    }
  }
}
</script>
