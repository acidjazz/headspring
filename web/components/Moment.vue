<template lang="pug">
  time(:datetime="datetime") ...
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
      document.querySelectorAll('time').forEach((el) => {
        el.innerHTML = moment(el.getAttribute('datetime')).fromNow()
      })
    }
  },
  mounted () {
    if (window.moment !== undefined) {
      return true
    }
    this.set()
    window.moment = setInterval(this.set, this.delay)
  },
}
</script>
