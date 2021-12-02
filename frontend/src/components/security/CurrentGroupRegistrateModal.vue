<template>
  <MainModalLayout
    :isOpen="isOpen"
    :onClose="onClose"
    :onConfirm="onConfirm"
    :title="'Зарегестрировать новую смену'"
  >
    <v-form 
      class="pt-5"
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-row>
        <v-col>
          <v-combobox
            v-model="chief"
            :items="filterChief"
            item-text="value"
            item-value="id"
            outlined
            dense
            label="Начальник смены"
            :filter="filter"
            @change="search=''"
            :search-input.sync="search"
            auto-select-first
            :rules="rulesSingleSec"
          >
            <template slot="selection" slot-scope="data">
              <v-chip small>{{ data.item.lastName }} {{ data.item.name }}</v-chip>
            </template>
            <template slot="item" slot-scope="data">
              {{ data.item.lastName }} {{ data.item.name }}
            </template>
          </v-combobox>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-combobox
            v-model="operator"
            :items="filterOperator"
            item-text="value"
            item-value="id"
            outlined
            dense
            label="Оператор"
            @change="search2=''"
            :search-input.sync="search2"
            auto-select-first
            :rules="rulesSingleSec"
          >
            <template slot="selection" slot-scope="data">
              <v-chip small>{{ data.item.lastName }} {{ data.item.name }}</v-chip>
            </template>
            <template slot="item" slot-scope="data">
              {{ data.item.lastName }} {{ data.item.name }}
            </template>
          </v-combobox>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-combobox
            v-model="securities"
            :items="securityList"
            item-text="value"
            item-value="id"
            outlined
            dense
            label="Сотрудники смены"
            multiple
            :filter="filter"
            @change="search3=''"
            :search-input.sync="search3"
            auto-select-first
          >
            <template v-slot:selection="{ attrs, item, parent, selected }">
              <v-chip
                v-if="item === Object(item)"
                v-bind="attrs"
                :input-value="selected"
                small
              >
                <span class="pr-2">
                  {{ item.lastName }} {{ item.name }}
                </span>
                <v-icon
                  small
                  @click="parent.selectItem(item)"
                >
                  $delete
                </v-icon>
              </v-chip>
            </template>
            <template slot="item" slot-scope="data">
              {{ data.item.lastName }} {{ data.item.name }}
            </template>
          </v-combobox>
        </v-col>
      </v-row>
    </v-form>
  </MainModalLayout>
</template>

<script>
import MainModalLayout from '@/components/app/modals/MainModalLayout.vue'

export default {
  components: {
    MainModalLayout
  },

  data() {
    return {
      search: null,
      search2: null,
      search3: null,
      valid: true,

      rulesSingleSec: [
        v => typeof v === 'object' && v !== null || 'Данные не введены или введены некорректно'
      ]
    }
  },

  computed: {
    isOpen() { return this.$store.getters['securityGroup/securityGroupModalOpen'] },

    securityList() {
      return this.$store.getters['security/securities']
    },

    addSecurityModalValue() {
      return this.$store.getters['securityGroup/addSecurityModalValue']
    },

    filterChief() {
      return this.securityList.filter(item => item.roleSecurityId == 1)
    },

    filterOperator() {
      return this.securityList.filter(item => item.roleSecurityId == 2)
    },

    chief: {
      get() { return this.addSecurityModalValue.chief },
      set(value) { this.$store.commit('securityGroup/addModalValue', { key: 'chief', value}) }
    },

    operator: {
      get() { return this.addSecurityModalValue.operator },
      set(value) { this.$store.commit('securityGroup/addModalValue', { key: 'operator', value}) }
    },

    securities: {
      get() { return this.addSecurityModalValue.securities },
      set(value) { this.$store.commit('securityGroup/addModalValue', { key: 'securities', value}) }
    },

  },

  methods: {
    onClose() {
      this.$store.commit('securityGroup/securityGroupModalClose')
    },

    onConfirm() {
      if(this.$refs.form.validate()) {
        let data = {
          chiefId: this.chief.id,
          operatorId: this.operator.id,
          securitiesId: this.securities.map(item => {
            if(typeof item === 'object' && item !== null) {
              return item.id
            }
          })
        }

        if(this.addSecurityModalValue.id) {
          this.$store.dispatch('securityGroup/editGroup', { data, id: this.addSecurityModalValue.id })
        } else {
          this.$store.dispatch('securityGroup/addGroup', data)
        }
      }

    },

    filter (item, queryText) {
      const hasValue = val => val != null ? val : ''

      const text = hasValue(item.lastName)
      const query = hasValue(queryText)
      return text.toString()
        .toLowerCase()
        .indexOf(query.toString().toLowerCase()) > -1
    },
  }
}
</script>