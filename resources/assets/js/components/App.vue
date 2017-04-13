<template>
  <div class="container">
    <h4>Test</h4>

    <ContactForm @created="fetch"></ContactForm>

    <div class="ContactList" v-show="contacts.length > 0">
      <Contact v-for="(person, index) in contacts" :key="index" :contact="person" @updated="update" @deleted="remove(index)"></Contact>
    </div>
    <p v-show="contacts.length === 0">You do not have any contacts yet.</p>

    <transition name="fade">
      <MainLoader v-if="loading"></MainLoader>
    </transition>
  </div>
</template>

<script>
import axios from 'axios';
import Contact from './Contact';
import ContactForm from './ContactForm';
import MainLoader from './MainLoader';

export default {
  components: {
    Contact,
    ContactForm,
    MainLoader
  },

  data () {
    return {
      contacts: [],
      loading: false
    }
  },

  mounted () {
    this.fetch();
  },

  methods: {

    fetch () {
      console.log('App -> fetch');
      this.loading = true;
      axios.get('/contacts')
        .then((response) => {
          console.log('App -> fetch success');
          console.log(response.data);
          this.contacts = response.data;
          this.loading = false;
        })
        .catch((response) => {
          console.log('App -> fetch error');
          // show error
          this.loading = false;
        })
    },

    update (data) {
      // this.fetch();
      var i = this.contacts.indexOf(data.contact);
      for (var d in data) {
        this.contacts[i][d] = data[d];
      }
    },

    remove (i) {
      console.log(`App -> remove ID: ${i}`);
      this.contacts.splice(i, 1);
    }

  }
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to {
  opacity: 0
}
</style>
