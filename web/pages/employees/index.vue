<template lang="pug">
#app
  Top
  section.section
    .container
      nav.breadcrumb.is-medium(arial-label="breadcrumbs")
        ul
          li: router-link(to="/employees") Employees
          li.is-active: a List
  .container
    .has-text-centered.has-text-primary(v-if="result === undefined")
      span.icon.is-large
        i.fa.fa-spinner.fa-pulse

    div(v-else)

      nav.level
        .level-left
          .level-item
            p.subtitle.is-5
              strong {{ numeral(result.paginate.total).format('0,0') }} 
              | Employees
          .level-item
            .field.has-addons
              p.control
                input.input(type="text",placeholder="Find an Employee",v-model="params.search")
              p.control
                button.button Search
        .level-right
          p.level-item(v-if="params.active === 'both'")
            strong All
          p.level-item(v-else)
            a(@click="params.active = 'both'") All

          p.level-item(v-if="params.active === true")
            strong Active
          p.level-item(v-else)
            a(@click="params.active = true") Active

          p.level-item(v-if="params.active === false")
            strong Inactive
          p.level-item(v-else)
            a(@click="params.active = false") Inactive

          p.level-item
            router-link.button.is-primary(to="/employees/new") New

      section.section.has-text-centered(v-if="result.data.length === 0")
        span.icon
          i.fa.fa-bell
        span &nbsp; No employees found
      table.table(v-else)
        thead
          tr
            th Name
            th E-mail 
            th Title 
            th Updated 
            th Active 
        transition-group(name="e",tag="tbody")
          router-link(
            v-for="employee in result.data",
            :key="employee._id",
            tag="tr",
            :to="'/employees/' + employee._id").e-item
            td 
              | {{ employee.firstname }}
              | {{ employee.lastname }}
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

      Paginate(:paginate="result.paginate",@change="params.page = $event")
  Toast(ref='toast')
</template>

<style lang="stylus">
tr
  cursor pointer
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
      let config = {
        headers: {'Accept': 'application/json'}
      }
      axios.get('http://localhost:8000/employees', {params: this.params, headers: {'Accept': 'application/json'}})
      .then((res) => {
        this.result = res.data
      })
    },
  },

  watch: {
    'params.search' (value) {
      this.get()
    },
    'params.page' (value) {
      this.get()
    },
    'params.active' (value) {
      this.params.page = 1
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
      complete: 0,
      params: {
        page: 1,
        active: 'both',
        search: '',
      },
      result: undefined,
    }
  }

}
</script>
