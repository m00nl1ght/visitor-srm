<template>
  <v-expansion-panels
    v-model="panel"
    multiple
  >
    <v-expansion-panel>
      <v-expansion-panel-header>
        <div >
          <v-badge
            :content="reportData.events ? (reportData.events.length || '0') : '0'"
            offset-y="7"
            offset-x="0"
          >События</v-badge>
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
        <div >
          <v-badge
            :content="reportData.alarms ? (reportData.alarms.length || '0') : '0'"
            offset-y="7"
            offset-x="0"
          >Открытые неисправности</v-badge>
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
        <div >
          <v-badge
            :content="reportData.visitors ? (reportData.visitors.length || '0') : '0'"
            offset-y="7"
            offset-x="0"
          >Посетители</v-badge>
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
        <div >
          <v-badge
            :content="reportData.cars ? (reportData.cars.length || '0') : '0'"
            offset-y="7"
            offset-x="0"
          >Автомобили</v-badge>
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
        <div >
          <v-badge
            :content="reportData.foggotenCard ? (reportData.foggotenCard.length || '0') : '0'"
            offset-y="7"
            offset-x="0"
          >Забытые карты доступа</v-badge>
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
import EventOpenTable from '@/components/events/EventOpenTable.vue'
import AlarmOpenTable from '@/components/alarms/AlarmOpenTable.vue'
import VisitorIncomeList from '@/components/visitors/VisitorsIncomeList.vue'
import CarIncomeList from '@/components/cars/CarsIncomeList.vue'
import CardIncomeTable from '@/components/cards/CardIncomeTable.vue'

export default {
  components: {
    EventOpenTable,
    AlarmOpenTable,
    VisitorIncomeList,
    CarIncomeList,
    CardIncomeTable
  },

  data() {
    return {
      panel: []
    }
  },

  computed: {
    reportData() {
      return this.$store.state.securityReport.reportBySecurityTeamData ? this.$store.state.securityReport.reportBySecurityTeamData : {} 
    }
  },

  mounted() {
    // this.$store.dispatch('securityReport/getReportBySecurityTeam', this.$moment(new Date()).format('YYYY-MM-DD'))
    this.$store.dispatch('securityReport/getReportBySecurityTeam', '2021-09-10')
  }
}
</script>