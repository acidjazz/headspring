<template lang="pug">
#app
  Top
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
                strong {{ numeral(api.result.paginate.total).format('0,0') }} 
                | Employees
            .level-item
              .field.has-addons
                p.control
                  input.input(type="text",placeholder="Find an Employee")
                p.control
                  button.button Search
          .level-right
            p.level-item(v-if="api.params.active === 'both'")
              strong All
            p.level-item(v-else)
              a(@click="api.params.active = 'both'") All

            p.level-item(v-if="api.params.active === true")
              strong Active
            p.level-item(v-else)
              a(@click="api.params.active = true") Active

            p.level-item(v-if="api.params.active === false")
              strong Inactive
            p.level-item(v-else)
              a(@click="api.params.active = false") Inactive

            p.level-item
              router-link.button.is-primary(to="/employees/new") New

        table.table
          thead
            tr
              th Name
              th E-mail 
              th Title 
              th Updated 
              th Active 
          transition-group(name="e",tag="tbody")
            tr(v-for="employee in api.result.data",:key="employee._id").e-item
              td {{ employee.firstname }} {{ employee.lastname }}
              td {{ employee.email }}
              td {{ employee.title }}
              td
                Moment(:datetime="employee.updated_at")
              td(v-if="employee.active").has-text-centered
                span.icon
                  i.fa.fa-check.has-text-success
              td(v-else).has-text-centered
                span.icon.has-text-danger
                  i.fa.fa-ban

        Paginate(:paginate="api.result.paginate",@change="api.params.page = $event")
  Toast(ref='toast')
</template>

<style lang="stylus">
.e-item 
  transition opacity 1s, transform 1s
.e-enter, .e-leave-to
  opacity 0
  trasform translate(10px, 0)
.e-list-move
  transition opacity 1s, transform 1s
.e-leave-active 
  display none

</style>

<script>

import axios from 'axios'

import Top from '~/components/Top.vue'
import Toast from '~/components/Toast.vue'
import Paginate from '~/components/Paginate.vue'
import Moment from '~/components/Moment.vue'

import numeral from 'numeral'

export default {
  components: {
    Top,
    Toast,
    Paginate,
    Moment,
  },

  methods: {

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
    },
    'api.params.active' (value) {
      this.api.params.page = 1
      this.get()
    }
  },

  mounted () {
    // this.$refs.toast.add({body: 'mounted()'})
    this.get()
  },

  data () {

    return {
      numeral: numeral,
      api: {
        complete: 0,
        params: {
          page: 1,
          active: 'both',
        },
        result: undefined,
      }
    }
  }

}
</script>
