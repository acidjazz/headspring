<template lang="pug">
#Toasts
  transition-group(name="toast-list",tag="ul")
    article.message.toast-list-item(
      v-for="toast, index of content",
      :key="toast.id",
      :class="type(toast.type)")
      .message-header
        p {{ toast.title}}
        button.delete(@click="remove(toast.id)")
      .message-body {{ toast.body}} 
  // section.section
    .container
      .columns
        .column.is-half
          .field.is-horizontal
            .field-label.is-normal
              label.label Type
            .field-body
              .field
                .control
                  .select.is-fullwidth
                    select(v-model="a.type")
                      option info
                      option error
                      option success
                      option normal
          .field.is-horizontal
            .field-label.is-normal
              label.label Title
            .field-body
              .field
                .control: input.input(type="text",v-model="a.title")
          .field.is-horizontal
            .field-label.is-normal
              label.label Body
            .field-body
              .field
                .control: input.input(v-model="a.body")
          .field.is-horizontal
            .field-label.is-normal
              label.label Timeout
            .field-body
              .field
                .control: input.input(type="number",v-model="a.timeout")
          .field.is-horizontal
            .field-label
            .field-body
              .field
                .control
                  button.button.is-primary(
                    @click="add({title: a.title, type: a.type, body: a.body, timeout: a.timeout})"
                  ) Create Toast
</template>

<style lang="stylus">

#Toasts > ul
  position fixed
  top 80px
  right 20px
  z-index 10

.toast-list-item
  transition all 1s
  width 300px

.toast-list-enter, .toast-list-leave-to
  opacity 0
  transform translate(30px, 0)

.toast-list-move
  transition transform 1s, opacity 1s

.toast-list-leave-active
  position absolute

</style>

<script>
export default {

  methods: {

    add (params) {
      for (let key in this.defaults) {
        if (params[key] === undefined) {
          params[key] = this.defaults[key]
        }
      }

      params.created = Date.now()
      params.id = Math.random()
      params.expire = setTimeout(() => { this.remove(params.id) }, params.timeout * 1000)

      this.content.unshift(params)
    },

    remove (id) {
      this.content.splice(this.index(id), 1)
    },
    index (id) {
      for (let key in this.content) {
        if (id === this.content[key].id) {
          return key
        }
      }
    },

    type (type) {
      switch (type) {
        case 'error' :
          return 'is-danger'
        case 'success' :
          return 'is-success'
        case 'info' :
          return 'is-info'
      }
    },

  },

  data () {
    return {
      defaults: {
        title: 'debug',
        body: 'body',
        timeout: 5,
      },
      content: [],
      // a: { title: 'title', body: 'body', type: 'info', timeout: 3 },
    }
  },
  /*
  created () {
    this.add({ title: 'title', body: 'this is a toast', timeout: 1 })
    this.add({ title: 'error title', type: 'error', body: 'this is an error', timeout: 2 })
    this.add({ title: 'succcess title', type: 'success', body: 'this is a success', timeout: 3 })
    this.add({ title: 'info title', type: 'info', body: 'this is information', timeout: 4 })
  }
  */
}
</script>
