import { APICourseArrayItem } from "./course"

export interface APIModuleArrayItem {
    id: string
    title: string
    description: string
    course_id: string
    is_premium: boolean,
    publish: boolean,
    order: number,
    created_at: string,
    updated_at: string,
    deleted_at: string | null
}

export interface APIModuleResponse {

    id: string
    title: string
    description: string
    course_id: string
    is_premium: boolean
    publish: boolean
    order: number
    course: APICourseArrayItem
    lessons: [],
    created_at: string,
    updated_at: string
}


export interface APIModuleRequest {
    title: string
    description: string
    course_id: string
    is_premium: boolean,
    publish: boolean,
    order: number,
}