import { createRouter, createWebHashHistory } from 'vue-router'
import home from '../views/Home/home.vue'
import login from '../views/Login/login.vue'
import navsTamplete from '../layouts/tampleteP.vue'
import addUser from '../views/User/addUser.vue'
import userDashboard from '../views/User/userDashboard.vue'
import userEdit from '../views/User/editUser.vue'
import staffDashboard from '../views/Staff/staffDashboard.vue'
import addStaff from '../views/Staff/addStaffs.vue'
import editStaff from '../views/Staff/editStaff.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: home,
        meta: {
            layout: navsTamplete
        }

    },
    {
        path: '/login',
        name: 'login',
        component: login
    },
    {
        path: '/user/add',
        name: 'addUser',
        component: addUser,
        meta: {
            layout: navsTamplete
        }
    },
    {
        path: '/user/dashboard',
        name: 'userDashboard',
        component: userDashboard,
        meta: {
            layout: navsTamplete
        }
    },
    {
        path: '/user/edit/:id',
        name: 'userEdit',
        component: userEdit,
        meta: {
            layout: navsTamplete
        },
        props: true,
    },
    {
        path: '/staff/dashboard',
        name: 'staffDashboard',
        component: staffDashboard,
        meta: {
            layout: navsTamplete
        },
    },
    {
        path: '/staff/addStaff',
        name: 'addStaff',
        component: addStaff,
        meta: {
            layout: navsTamplete
        },
    },
    {
        path: '/staff/editStaff/:id',
        name: 'editStaffs',
        component: editStaff,
        props: true,
        meta: {
            layout: navsTamplete
        },
    },


]
const router = createRouter({
    history: createWebHashHistory(),
    routes
})

//   router.beforeEach(async(to)=>{
//         const publicPage=['/login']
//         const authRequired=!publicPage.includes(to.path)
//         if(authRequired && !localStorage.getItem('token')){
//             return '/login';
//         }
//   })
router.beforeEach(async (to) => {

    const publicPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    if (authRequired && !localStorage.getItem('token')) {
        return '/login';
    }
});

export default router
