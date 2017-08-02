<template lang="pug">
time(:datetime="datetime") {{ value }}
</template>

<script>
import moment from 'moment'
export default {
  props: {
    datetime: {
      required: true,
      type: String,
    },
    delay: {
      type: Number,
      default: 10000
    }
  },
  methods: {
    set () {
      this.value = moment(this.datetime).fromNow()
    }
  },
  mounted () {
    this.set()
    this.interval = setInterval(this.set, this.delay)
  },

  beforeDestroy () {
    clearInterval(this.interval)
  },

  data () {
    return {
      interval: false,
      value: '...',
    }
  },
}
</script>
