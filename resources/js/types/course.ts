

export type CourseLevel = 'BEGINNER' | 'INTERMEDIATE' | 'ADVANCED'

export interface APICourseArrayItem {
    id: string
    title: string
    description: string
    level: CourseLevel
    is_premium: boolean
    publish: boolean
    author_id?: string
    author?: string
    modules_count: number
    students_count: number
    created_at: string
    updated_at: string
}