<template lang="pug">
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
  }
}

</script>
