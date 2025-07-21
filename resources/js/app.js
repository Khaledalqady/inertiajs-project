import { createApp, h } from 'vue';
import { createInertiaApp, Link , Head} from '@inertiajs/vue3';
import Layout from './Shared/Layout';
//import { InertiaProgress } from '@inertiajs/progress';
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

createInertiaApp({
  resolve: async name => {
    const page = (await import(`./Pages/${name}.vue`)).default;

    if (page.layout === undefined){
      page.layout = Layout;
    }
    //page.layout ??= Layout;
    return page;
},
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link" , Link)
      .component("Head", Head)
      .mount(el);
  },

  title: title => `My App - ${title}`,
});

router.on('start', () => NProgress.start())
router.on('finish', () => NProgress.done())
