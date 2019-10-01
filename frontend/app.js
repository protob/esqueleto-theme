
// // Styles.
// import './style.scss'
import Vue from 'vue'
import molecules from './components/molecules/molecules'
import initExample from "./js/example-module";


const ready = callback => {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', callback)
  } else {
    callback()
  }
}

import exampleComp from './vue/example-component.vue'
function initVue() {
  const app = new Vue({
    el: '#example-vue',
    components: {
      exampleComp
    },
    data: {
    },
    methods: {
    }
  })


}

// Call functions when dom is ready.
ready(() => {
  molecules()
  initExample();
  if(document.querySelector("#example-vue"))
  initVue();
})