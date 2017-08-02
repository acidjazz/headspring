<template lang="pug">
#app
  .navbar.has-shadow
    .container
      .navbar-brand
        .navbar-item
          img(src="/logo.jpg")
          .title.is-4 headspring
        a.navbar-item.is-tab.is-active Employees
        a.navbar-item.is-tab Settings
        a.navbar-item.is-tab Options
      .navbar-end
        a.navbar-item(href="https://github.com/acidjazz/headspring", target="_blank")
          .icon
            i.fa.fa-github
  section.section
    .container
      h1.title Employees
      h2.subtitle Headspring Employee Directory
      hr
      .content
        .columns
          .column.is-one-quarter one-quarter
          .column the rest 
  Toast(ref='Toast')
</template>

<script>

import Toast from '~/components/Toast.vue'

export default {
  components: {
    Toast
  },

  mounted () {
  }

}
</script>

<style lang="stylus">
.container
  max-width 960px
  width 960px
</style>
