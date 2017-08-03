<template lang="pug">
  nav.pagination(v-if="paginate.last_page !== 1")
    a.pagination-previous(
      v-if="paginate.current_page === 1",
      disabled) Previous
    a.pagination-previous(
      v-else,
      @click="change(paginate.current_page - 1)") Previous
    a.pagination-next(
      v-if="paginate.current_page === paginate.last_page",
      disabled) Previous
    a.pagination-next(v-else
      @click="change(paginate.current_page + 1)") Next Page
    ul.pagination-list
      li(v-for="page in paginate.pages")
        span.pagination-ellipsis(v-if="page === '...'") &hellip;
        a.pagination-link(
          v-else,
          :class="{'is-current': paginate.current_page === page}",
          @click="change(page)") {{ numeral(page).format('0,0') }}
</template>
<script>
import numeral from 'numeral'
export default {
  props: ['paginate', 'current'],
  methods: {
    change (page) {
      this.$emit('change', page)
    }
  },
  data () {
    return {
      numeral: numeral
    }
  },
}
</script>

