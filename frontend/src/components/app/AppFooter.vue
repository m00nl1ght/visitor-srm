<template>
  <v-footer app color="#120a38">
    <v-container>
      <v-row>
        <v-col>
          <div class=" d-flex justify-center">
            <a class="text-decoration-none blue-grey--text" href="https://vk.com/id24405913">&copy; {{ getYear }}, Виталий Ковешников</a>
            <span></span>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script>
export default {
  computed: {
    getYear() {
      return this.$moment().year()
    }
  }
}
</script>

<style lang="scss" scoped></style>
