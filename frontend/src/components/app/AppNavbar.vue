<template>
  <v-navigation-drawer
    app
    clipped
  >
    <v-list
      dense
      nav
    >
      <v-list-item-group color="primary">
        <v-list-item
          :to="{ name: 'Home' }"
          exact
        >
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>Главная</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item
          v-for="item in items"
          :key="item.title"
          :to="{ name: item.pathName }"
        >
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
export default {
  data: () => ({
    items: [
      { pathName: 'Security', title: 'Смена охраны', icon: 'mdi-shield-account' },
      { pathName: 'Visitors', title: 'Посетители', icon: 'mdi-account-multiple' },
      { pathName: 'Cars', title: 'Автомобили', icon: 'mdi-truck' },
      { pathName: 'Alarms', title: 'Неисправности', icon: 'mdi-alert-rhombus' },
      { pathName: 'Events', title: 'События', icon: 'mdi-clipboard-list' },
      { pathName: 'Cards', title: 'Карты доступа', icon: 'mdi-card-account-details' },
      { pathName: 'Reports', title: 'Отчеты', icon: 'mdi-chart-line' },
      { pathName: 'Devices', title: 'ИТ устройства', icon: 'mdi-monitor' },
      { pathName: 'Admins', title: 'Администратор', icon: 'mdi-shield-crown-outline' }
    ]
  })
}
</script>