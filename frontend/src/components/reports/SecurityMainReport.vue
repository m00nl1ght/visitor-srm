<template>
  <v-expansion-panels
    v-model="panel"
    multiple
  >
    <v-expansion-panel>
      <v-expansion-panel-header>
        <div>
          <v-badge
            :content="reportData.events ? reportData.events.length || '0' : '0'"
            offset-y="7"
            offset-x="0"
          >
            События
          </v-badge>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <EventOpenTable
          :items="reportData.events"
          disabled
        />
      </v-expansion-panel-content>
    </v-expansion-panel>

    <v-expansion-panel>
      <v-expansion-panel-header>
        <div>
          <v-badge
            :content="reportData.alarms ? reportData.alarms.length || '0' : '0'"
            offset-y="7"
            offset-x="0"
          >
            Открытые неисправности
          </v-badge>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <AlarmOpenTable
          :items="reportData.alarms"
          disabled
        />
      </v-expansion-panel-content>
    </v-expansion-panel>

    <v-expansion-panel>
      <v-expansion-panel-header>
        <div>
          <v-badge
            :content="reportData.visitors ? reportData.visitors.length || '0' : '0'"
            offset-y="7"
            offset-x="0"
          >
            Посетители
          </v-badge>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <VisitorIncomeList
          :items="reportData.visitors"
          disabled
        />
      </v-expansion-panel-content>
    </v-expansion-panel>

    <v-expansion-panel>
      <v-expansion-panel-header>
        <div>
          <v-badge
            :content="reportData.cars ? reportData.cars.length || '0' : '0'"
            offset-y="7"
            offset-x="0"
          >
            Автомобили
          </v-badge>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <CarIncomeList
          :items="reportData.cars"
          disabled
        />
      </v-expansion-panel-content>
    </v-expansion-panel>

    <v-expansion-panel>
      <v-expansion-panel-header>
        <div>
          <v-badge
            :content="reportData.foggotenCard ? reportData.foggotenCard.length || '0' : '0'"
            offset-y="7"
            offset-x="0"
          >
            Забытые карты доступа
          </v-badge>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <CardIncomeTable
          :items="reportData.foggotenCard"
          disabled
        />
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
import EventOpenTable from '@/components/reports/tables/ReportEventOpenTable.vue'
import AlarmOpenTable from '@/components/reports/tables/ReportAlarmOpenTable.vue'
import VisitorIncomeList from '@/components/reports/tables/ReportVisitorIncomeList.vue'
import CarIncomeList from '@/components/reports/tables/ReportCarIncomeList.vue'
import CardIncomeTable from '@/components/reports/tables/ReportCardIncomeTable.vue'

export default {

  components: {
    EventOpenTable,
    AlarmOpenTable,
    VisitorIncomeList,
    CarIncomeList,
    CardIncomeTable
  },
  props: {
    reportData: {
      type: Object,
      default: () => {}
    }
  },

  data() {
    return {
      panel: []
    }
  }
}
</script>
