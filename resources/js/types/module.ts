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

export interface APIModuleRequest {
    title: string
    description: string
    course_id: string
    is_premium: boolean,
    publish: boolean,
    order: number,
}