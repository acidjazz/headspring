<template lang="pug">
#app
  Top
  section.section
    .container
      h1.title Home
      h2.subtitle Proceed to Employees section
</template>

<style lang="stylus" scoped>
.container
  max-width 960px
  width 960px
</style>

<script>
import Top from '~/components/Top.vue'
export default { components: { Top } }
</script>
