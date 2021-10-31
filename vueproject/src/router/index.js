import VueRouter from 'vue-router'
import AllFilmsPage from '../pages/AllFilmsPage'
import AllApi from '../pages/AllApi'


export default new VueRouter({
    mode:'history',
    routes:[
        {
            path: '/films',
            component: AllFilmsPage
        },
        {
            path: '/',
            component: AllApi
        }
    ] // short for `routes: routes`
})