<template>
  <div class="Contact panel panel-default">
    <div class="panel-heading">
      <a :href="'tel:' + contact.phone">
        <i class="glyphicon glyphicon-earphone"></i>
      </a>

      <a class="tool" href="#" @click.prevent="remove">
        <i class="glyphicon glyphicon-remove pull-right"></i>
      </a>

      <a class="tool" href="#" @click.prevent="editing = true" v-show="!editing">
        <i class="glyphicon glyphicon-pencil pull-right"></i>
      </a>
    </div>
    <div class="panel-body">
      <div class="live" v-show="!editing">
        {{ contact.first }} {{ contact.last }}
      </div>
      <div class="editing" v-show="editing">
        <p>
          <input type="text" v-model="first" />
          <input type="text" v-model="last" />
          <input type="text" v-model="phone" />
        </p>
        <p>
          <button class="btn btn-success" @click="save">Save</button>
          <button class="btn btn-default" @click="cancel">Cancel</button>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  props: [
    'contact'
  ],

  data () {
    return {
      first: this.contact.first,
      last: this.contact.last,
      phone: this.contact.phone,
      editing: false,
      loading: false
    }
  },

  methods: {

    remove () {
      console.log('Contact -> remove');
      this.loading = true;
      axios.delete(`/contacts/${this.contact.id}`)
        .then((response) => {
          console.log('Contact -> remove success');
          this.$emit('deleted')
          this.loading = false;
        })
        .catch((error) => {
          console.log('Contact -> remove error');
          // stop deleting and dont remove from the dom
          // tell the user deletion failed
        });
    },

    save () {
      console.log('Contact -> save');
      axios.put(`/contacts/${this.contact.id}`, {
          first: this.first,
          last: this.last,
          phone: this.phone
        })
        .then((response) => {
          console.log('Contact -> save success');
          this.$emit('updated', {
            contact: this.contact,
            first: this.first,
            last: this.last,
            phone: this.phone
          });
          this.editing = false;
        })
        .catch((error) => {
          console.log('Contact -> save error');
          //show the user that it couldn't be updated
        });
    },

    cancel () {
      console.log('Contact -> cancel');
      this.first = this.contact.first;
      this.last = this.contact.last;
      this.phone = this.contact.phone;
      this.editing = false;
    }

  }

}
</script>

<style>
.tool > i {
  margin-left: 15px;
}
</style>
