<template lang="pug">
#emlpoyees
  Top
  section.section
    .container
      h1.title Employees
      h2.subtitle Headspring Employee Directory

      .columns
        .column
          .field.is-horizontal
            .field-label.is-normal
              label.label Name
            .field-body
              .field
                p.control.has-icons-left
                  input.input(type="text",placeholder="First Name")
                  span.icon.is-small.is-left
                    i.fa.fa-user
              .field
                p.control.has-icons-left
                  input.input(type="text",placeholder="Last Name")
                  span.icon.is-small.is-left
                    i.fa.fa-user
          .field.is-horizontal
            .field-label.is-normal
              label.label E-mail Address
            .field-body
              .field
                p.control.has-icons-left
                  input.input(type="email")
                  span.icon.is-small.is-left
                    i.fa.fa-envelope
          .field.is-horizontal
            .field-label.is-normal
              label.label Job Title
            .field-body
              .field
                p.control.has-icons-left
                  input.input(type="text",placeholder="Sales Manager")
                  span.icon.is-small.is-left
                    i.fa.fa-id-badge
          .field.is-horizontal
            .field-label.is-normal
              label.label Active
            .field-body
              .field.is-narrow
                .control
                  label.checkbox
                    input(type="checkbox")
          .field.is-horizontal
            .field-label.is-normal
              label.label Address
            .field-body
              .field
                p.control.has-icons-left
                  input.input(type="text",placeholder="Street")
                  span.icon.is-small.is-left
                    i.fa.fa-address-card
          .field.is-horizontal
            .field-label.is-normal
              label.label
            .field-body
              .field
                p.control
                  input.input(type="text",placeholder="City")
              .field
                p.control
                  input.input(type="text",placeholder="State")
              .field
                p.control
                  input.input(type="text",placeholder="Zip Code")
          .field.is-horizontal
            .field-label.is-normal
              label.label
            .field-body
              .field
                p.control
                  button.button.is-primary Add Employee

</template>


<script>
import Top from '~/components/Top'
export default {
  components: { Top },
}
</script>
