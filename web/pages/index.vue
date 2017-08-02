<template lang="pug">
#app
  .navbar.has-shadow
    .container
      .navbar-brand
        .navbar-item
          img(src="/logo.jpg")
          .title.is-4 headspring
        a.navbar-item.is-tab(@click="incomplete('Home')") Home
        a.navbar-item.is-tab.is-active Employees
        a.navbar-item.is-tab(@click="incomplete('Dashboard')") Dashboard
      .navbar-end
        a.navbar-item(@click="incomplete('Settings')")
          .icon
            i.fa.fa-gear
        a.navbar-item(href="https://github.com/acidjazz/headspring", target="_blank")
          .icon
            i.fa.fa-github
  section.section
    .container
      h1.title Employees
      h2.subtitle Headspring Employee Directory
      .data.has-text-centered.has-text-primary(v-if="api.result === undefined")
        span.icon.is-large
          i.fa.fa-spinner.fa-pulse

      .data.has-text-centered(v-else-if="api.result.data.length === 0")
        span.icon
          i.fa.fa-bell
        span &nbsp; No employees found

      .data(v-else)

        nav.level
          .level-left
            .level-item
              p.subtitle.is-5
                strong {{ api.result.paginate.total }} 
                | Employees
            .level-item
              .field.has-addons
                p.control
                  input.input(type="text",placeholder="Find an Employee")
                p.control
                  button.button Search
          .level-right
            p.level-item
              strong All
            p.level-item
              a Active
            p.level-item
              a Inactive
            p.level-item
              a.button.is-primary New

        table.table
          thead
            tr
              th First Name
              th Last Name
              th E-mail 
              th Title 
              th Updated 
          tbody
            tr(v-for="employee in api.result.data")
              td {{ employee.firstname }}
              td {{ employee.lastname }}
              td {{ employee.email }}
              td {{ employee.title }}
              td
                Moment(:datetime="employee.updated_at")

        Paginate(:paginate="api.result.paginate",@change="api.params.page = $event")

  Toast(ref='Toast')
</template>

<script>

import axios from 'axios'
import Toast from '~/components/Toast.vue'
import Paginate from '~/components/Paginate.vue'
import Moment from '~/components/Moment.vue'

export default {
  components: {
    Toast,
    Paginate,
    Moment,
  },

  methods: {
    incomplete (name) {
      this.$refs.Toast.add({
        type: 'error',
        title: 'Error',
        body: '"' + name + '" is incomplete'
      })
    },

    get () {
      axios.get('http://localhost:8000/api/employees', {params: this.api.params})
      .then((res) => {
        this.api.result = res.data
      })
    },
  },

  watch: {
    'api.params.page' (value) {
      this.get()
    }
  },

  mounted () {
    this.get()
  },

  data () {

    return {
      api: {
        complete: 0,
        params: {
          page: 1,
        },
        result: undefined,
      }
    }
  }

}
</script>

<style lang="stylus">
.container
  max-width 960px
  width 960px
li
  list-style-type none
</style>
