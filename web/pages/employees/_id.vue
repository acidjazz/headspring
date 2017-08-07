<template lang="pug">
#emlpoyees
  Top
  section.section
    .container
      nav.breadcrumb.is-medium(arial-label="breadcrumbs")
        ul
          li: router-link(to="/employees") Employees
          li.is-active(v-if="$route.params.id === 'new'"): a New
          li.is-active(v-else): a {{ this.employee.firstname }} {{ this.employee.lastname }}
  .container.is-narrow
    .field.is-horizontal
      .field-label.is-normal
        label.label Name
      .field-body
        .field
          p.control.has-icons-left.has-icons-right
            input.input(type="text",placeholder="First Name",v-model="employee.firstname",
            :class="{'is-danger': this.errors.firstname}")
            span.icon.is-small.is-left
              i.fa.fa-user
            span.icon.is-small.is-right(v-if="employee.firstname !== ''")
              i.fa.fa-check
          p.help.is-danger {{ this.errors.firstname }}
        .field
          p.control.has-icons-left.has-icons-right
            input.input(type="text",placeholder="Last Name",v-model="employee.lastname",
            :class="{'is-danger': this.errors.lastname}")
            span.icon.is-small.is-left
              i.fa.fa-user
            span.icon.is-small.is-right(v-if="employee.lastname !== ''")
              i.fa.fa-check
          p.help.is-danger {{ this.errors.lastname }}
    .field.is-horizontal
      .field-label.is-normal
        label.label E-mail Address
      .field-body
        .field
          p.control.has-icons-left.has-icons-right
            input.input(type="email",v-model="employee.email",
            :class="{'is-danger': this.errors.email}")
            span.icon.is-small.is-left
              i.fa.fa-envelope
            span.icon.is-small.is-right(v-if="employee.email !== ''")
              i.fa.fa-check
          p.help.is-danger {{ this.errors.email }}
    .field.is-horizontal
      .field-label.is-normal
        label.label Job Title
      .field-body
        .field
          p.control.has-icons-left.has-icons-right
            input.input(type="text",placeholder="Sales Manager",v-model="employee.title",
            :class="{'is-danger': this.errors.title}")
            span.icon.is-small.is-left
              i.fa.fa-id-badge
            span.icon.is-small.is-right(v-if="employee.title !== ''")
              i.fa.fa-check
          p.help.is-danger {{ this.errors.title }}
    .field.is-horizontal
      .field-label.is-normal
        label.label Active
      .field-body
        .field.is-narrow
          .control
            label.checkbox
              input(type="checkbox",v-model="employee.active")
    .field.is-horizontal
      .field-label.is-normal
        label.label Address
      .field-body
        .field
          p.control.has-icons-left.has-icons-right
            input.input(type="text",placeholder="Street",v-model="employee.address.street",
            :class="{'is-danger': this.errors['address.street']}")
            span.icon.is-small.is-left
              i.fa.fa-address-card
            span.icon.is-small.is-right(v-if="employee.address.street !== ''")
              i.fa.fa-check
          p.help.is-danger {{ this.errors['address.street'] }}
    .field.is-horizontal
      .field-label.is-normal
        label.label
      .field-body
        .field
          p.control
            input.input(type="text",placeholder="City",v-model="employee.address.city",
            :class="{'is-danger': this.errors['address.city']}")
          p.help.is-danger {{ this.errors['address.city'] }}
        .field
          p.control.is-narrow
            input.input(type="text",placeholder="State",v-model="employee.address.state",
            :class="{'is-danger': this.errors['address.state']}")
          p.help.is-danger {{ this.errors['address.state'] }}
        .field.is-danger
          p.control
            input.input(
            type="text", placeholder="Zip Code", v-model="employee.address.zip",
            :class="{'is-danger': this.errors['address.zip']}")
          p.help.is-danger {{ this.errors['address.zip'] }}

    .field.is-horizontal
      .field-label.is-normal
        label.label
      .field-body
        .field
          p.control
            button.button.is-primary(v-if="$route.params.id === 'new'",@click="save()") Add Employee
            button.button.is-primary(v-else,@click="save()") Update Employee

  Toast(ref='toast')
</template>


<script>
import Top from '~/components/Top'
import Toast from '~/components/Toast.vue'
import axios from 'axios'
export default {

  components: { Top, Toast },

  validate ({ params }) {
    return /^[0-9a-fA-F]{24}|new/.test(params.id)
  },

  methods: {

    get () {
      axios.get('http://localhost:8000/employees', {params: {_id: this.$route.params.id}})
      .then(result => {
        this.result = result
        this.employee = result.data.data[0]
      })
    },

    save () {
      axios.post('http://localhost:8000/employees/modify', this.employee)
      .then(result => {
        this.toast({
          type: 'success',
          title: 'Success',
          body: result.data.data.status
        })

        if (result.data._id) {
          console.log('/employees/' + result.data._id)
          // this.$router.go('/employees/' + result.data.data._id)
        }

      })
      .catch(error => {
        if (error.response !== undefined) {
          this.error(error.response.data.errors)
        }
      })
    },

    toast (params) {
      this.$refs.toast.add(params)
    },

    error (errors) {
      this.errors = {}
      for (let error of errors) {
        if (error.type === 'ErrorException') {
          this.toast({
            type: 'error',
            title: 'Error',
            body: error.message
          })
        } else {
          this.errors[error.type] = error.message
        }
      }
    },

  },

  mounted () {
    if (this.$route.params.id !== 'new') {
      this.get()
    }
  },

  data () {

    return {
      result: undefined,
      errors: {},
      employee: {
        _id: this.$route.params.id,
        firstname: '',
        lastname: '',
        email: '',
        title: '',
        address: {
          street: '',
          city: '',
          state: '',
          zip: '',
        },
        active: true,
      }
    }
  }
}
</script>
