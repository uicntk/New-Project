import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'
import '../css/app.css'
import Layout from './Layouts/Layout.vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { faEdit } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faEdit)


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
      .use(ZiggyVue)
      .component('Link', Link)
      .component('Head', Head)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
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