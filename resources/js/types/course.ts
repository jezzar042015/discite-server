

export type CourseLevel = 'BEGINNER' | 'INTERMEDIATE' | 'ADVANCED' | ''

export interface APICourseArrayItem {
    id: string
    title: string
    description: string
    level: CourseLevel
    is_premium: boolean
    publish: boolean
    author_id?: string
    author?: string // actually this is another interface
    modules_count: number
    students_count: number
    created_at: string
    updated_at: string
}

export interface APICourseRequest {
    title: string
    description: string
    level: CourseLevel
    is_premium: boolean
    publish: boolean
}