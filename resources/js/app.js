import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'
import '../css/app.css'
import Layout from './Layouts/Layout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'


createInertiaApp({
  title: (title) => `My App ${title}`,
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('Link', Link)
      .component('Head', Head)
      .mount(el)
      .component('font-awesome-icon', FontAwesomeIcon)
  },
  progress: {
    // The color of the progress bar...
    color: 'red',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
})