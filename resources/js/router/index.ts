import { createRouter, createWebHistory } from 'vue-router'

import Dashboard from '@/pages/MainDashboard.vue'
import Courses from '@/pages/AvailableCourses.vue'
import Modules from '@/pages/CourseModules.vue'
import Lessons from '@/pages/ModuleLessons.vue'
import LessonContent from '@/pages/LessonContent.vue'
import Exercises from '@/pages/LessonExercises.vue'
import UsersList from '@/pages/UsersList.vue'
import UserProfile from '@/pages/UserProfile.vue'

import { canBrowseGuard, isAdminGuard } from './authGuards'

const routes = [
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
    },
    {
        path: '/courses/',
        name: 'Courses',
        component: Courses,
        beforeEnter: canBrowseGuard,
    },
    {
        path: '/courses/:id/modules',
        name: 'Modules',
        component: Modules,
        beforeEnter: canBrowseGuard,
    },
    {
        path: '/modules/:id/lessons',
        name: 'Lessons',
        component: Lessons,
        beforeEnter: canBrowseGuard,
    },
    {
        path: '/lessons/:id',
        name: 'LessonContent',
        component: LessonContent,
        beforeEnter: canBrowseGuard,    },
    {
        path: '/lessons/:id/exercises',
        name: 'Exercises',
        component: Exercises,
        beforeEnter: canBrowseGuard,
    },
    {
        path: '/users',
        name: 'Users',
        component: UsersList,
        beforeEnter: isAdminGuard,
    },
    {
        path: '/me',
        name: 'Profile',
        component: UserProfile,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 }
    }
})

export default router