import VueRouter from 'vue-router';
import Section from '@/components/Section';
import Page from '@/components/Page';
import Home from '@/views/Home';
import Subsection from '@/components/Subsection';
import NotFound from '@/components/NotFound';
import TrainingSubscribePage from '@/views/Trainings/TrainingSubscribePage';

const locales = JSON.parse(window_locales)
const homeSection = locales.filter((l) => l.key == currentAppLocale)
const homeSlug = homeSection[0].root_slug

const _routes = [
    {
        path: '/',
        redirect: '/fr'
    },
    {
        path: `/:locale/${homeSlug}`,
        redirect: `/${currentAppLocale}`
    },
    {
        path: '/:locale',
        component: Home,
        name: 'home'
    },
    {
        path: '/:locale/:slug1',
        component: Section,
        name: 'section',
    },
    {
        path: '/:locale/:slug1/:slug2',
        component: Subsection,
        name: 'subsection'
    },
    {
        path: '/:locale/:slug1/:slug2/:slug3',
        component: Page,
        name: 'page'
    },
    {
        path: '/:locale/:slug1/:slug2/:slug3/:trainingId',
        component: TrainingSubscribePage,
        name: 'subscribe'
    },
    {
        path: '/404',
        alias: '*',
        component: NotFound,
        name: 'not-found'
    }
];

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: _routes,
    linkActiveClass: 'active',
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
            return {
                selector: to.hash,
                behavior: 'smooth',
                offset: {
                    x: 0, y: 100
                }
            }
        } else {
            window.scrollTo(0,0)
        }
    }
});

router.beforeEach((to, from, next) => {
    const availableLocales = ['fr', 'en', 'it', 'de']
    if (to.params.locale && availableLocales.includes(to.params.locale)) {
        next()
    } else {
        next(`/fr`)
    }
});

export default router;
