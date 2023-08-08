<template>
  <v-navigation-drawer app clipped>
    <v-list dense nav>
      <v-list-item-group color="primary">
        <v-list-item :to="{ name: homePage }" exact>
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>Главная</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-for="item in items" :key="item.title" :to="{ name: item.pathName }">
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import * as routeNames from '@/router/names/index.js'

export default {
  data: () => ({
    homePage: routeNames.homePage,
    items: [
      // { pathName: routeNames.homePage, title: 'Главная', icon: 'mdi-home' },
      { pathName: routeNames.securityPage, title: 'Смена охраны', icon: 'mdi-shield-account' },
      { pathName: routeNames.visitorsPage, title: 'Посетители', icon: 'mdi-account-multiple' },
      { pathName: routeNames.carsPage, title: 'Автомобили', icon: 'mdi-truck' },
      { pathName: routeNames.alarmsPage, title: 'Неисправности', icon: 'mdi-alert-rhombus' },
      { pathName: routeNames.eventsPage, title: 'События', icon: 'mdi-clipboard-list' },
      { pathName: routeNames.cardsPage, title: 'Карты доступа', icon: 'mdi-card-account-details' },
      { pathName: routeNames.reportsPage, title: 'Отчеты', icon: 'mdi-chart-line' },
      { pathName: routeNames.devicesPage, title: 'ИТ устройства', icon: 'mdi-monitor' },
      { pathName: routeNames.adminPage, title: 'Администратор', icon: 'mdi-shield-crown-outline' }
    ]
  })
}
</script>
