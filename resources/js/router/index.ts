import { createRouter, createWebHistory } from 'vue-router'

import Dashboard from '@/pages/MainDashboard.vue'
import Courses from '@/pages/AvailableCourses.vue'
import Modules from '@/pages/CourseModules.vue'
import Lessons from '@/pages/ModuleLessons.vue'
import LessonContent from '@/pages/LessonContent.vue'
import Exercises from '@/pages/LessonExercises.vue'

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
    },
    {
        path: '/courses/:id/modules',
        name: 'Modules',
        component: Modules,
    },
    {
        path: '/modules/:id/lessons',
        name: 'Lessons',
        component: Lessons,
    },
    {
        path: '/lessons/:id',
        name: 'LessonContent',
        component: LessonContent,
    },
    {
        path: '/lessons/:id/exercises',
        name: 'Exercises',
        component: Exercises,
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