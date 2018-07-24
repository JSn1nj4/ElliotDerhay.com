
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

window.Event = new Vue();

Vue.component('menu-button', {
    methods: {
        toggle() {
            Event.$emit('menuToggled');
        }
    }
});

Vue.component('header-menu', {
    data() {
        return {
            menuVisible: false,
            opacity: '',
            zIndex: '',
            toggleDelay: 300
        };
    },

    methods: {
        toggleMenu() {
            this.menuVisible = !this.menuVisible;

            if(this.menuVisible) {

                this.zIndex = 50;
                setTimeout(() => {
                    this.opacity = 1;
                }, this.toggleDelay);

            } else {

                this.opacity = '';
                setTimeout(() => {
                    this.zIndex = '';
                }, this.toggleDelay);

            }
        }
    },

    created() {
        Event.$on('menuToggled', this.toggleMenu);
    }
});

const header = new Vue({
    el: '#header'
});
