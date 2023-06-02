<template>
  <div>
    <v-card>
      <div class="d-flex align-center pr-5">
        <v-card-title>Состав текущей смены</v-card-title>

        <v-spacer />
        
        <v-btn v-if="currentGroup && currentGroup.length !== 0" color="primary" outlined @click="openEditModal"> Редактировать смену </v-btn>

        <v-btn class="ml-3" color="primary" outlined @click="openAddModal"> Новая смена </v-btn>

        <v-btn class="ml-3" color="primary" outlined @click="sendReport"> Отправить отчет </v-btn>
      </div>

      <v-card-text>
        <v-alert v-if="!currentGroup || currentGroup.length == 0" border="top" colored-border type="warning" elevation="2">
          Смена на текущую дату еще не зарегестрирована!!
        </v-alert>

        <v-simple-table v-else>
          <template #default>
            <thead>
              <tr>
                <th class="text-left">Статус</th>
                <th class="text-left">Сотрудник</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Начальник смены</td>
                <td>{{ getShortName(currentGroup.chief) }}</td>
              </tr>

              <tr>
                <td>Оператор</td>
                <td>{{ getShortName(currentGroup.operator) }}</td>
              </tr>

              <tr v-for="security in currentGroup.securities" :key="security.id + '_' + security.name">
                <td>Инспектор пропускного режима</td>
                <td>{{ getShortName(security) }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
    </v-card>

    <CurrentGroupRegistrateModal />
  </div>
</template>

<script>
import CurrentGroupRegistrateModal from '@/components/security/CurrentGroupRegistrateModal.vue'
import peopleHelper from '@/services/helpers/people.js'

export default {
  components: {
    CurrentGroupRegistrateModal
  },

  computed: {
    currentGroup() {
      return this.$store.getters['securityGroup/currentGroup']
    }
  },

  methods: {
    getShortName(security) {
      return peopleHelper.getShortName(security)
    },

    openEditModal() {
      this.$store.commit('securityGroup/editGroupModalOpen', { ...this.currentGroup })
    },

    openAddModal() {
      this.$store.commit('securityGroup/addGroupModalOpen')
    },

    sendReport() {
      this.$store.dispatch('overviewReport/getSendedReport')
    }
  }
}
</script>
