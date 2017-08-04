<template lang="pug">
#Top
  header.navbar.has-shadow
    .container
      .navbar-brand
        .navbar-item
          img(src="/logo.jpg")
        .navbar-item
          .title.is-4.has-text-white headspring

        router-link.navbar-item.is-tab(to="/",:class="{'is-active': $route.name === 'index'}") Home
        router-link.navbar-item.is-tab(to="/employees",:class="{'is-active': $route.name.indexOf('employees') !== -1}") Employees
        a.navbar-item.is-tab(@click="incomplete('Dashboard')") Dashboard

      .navbar-end
        a.navbar-item(@click="incomplete('Settings')")
          .icon
            i.fa.fa-gear
        a.navbar-item(href="https://github.com/acidjazz/headspring", target="_blank")
          .icon
            i.fa.fa-github
        a.navbar-item.is-tab
          .icon
            i.fa.fa-user
  Toast(ref='toast')
</template>

<script>
import Toast from '~/components/Toast.vue'

export default {
  components: { Toast },
  methods: {
    incomplete (name) {
      this.$refs.toast.add({
        type: 'error',
        title: 'Error',
        body: '"' + name + '" is incomplete'
      })
    },
  },
  mounted () {
  },
}

</script>
<style lang="stylus">
.container
  max-width 960px
  width 960px
  &.is-narrow
    max-width 640px
    width 640px
li
  list-style-type none

table
  width 100%

td
  max-width 320px
  white-space nowrap
  overflow hidden
  text-overflow ellipsis



</style>
