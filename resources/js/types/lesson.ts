export interface APILessonArrayItem {
    id: string
    author_id: string | null
    title: string
    content: string
    module_id: string
    is_premium: boolean
    publish: boolean
    order: number
    created_at: string
    deleted_at: string | null
    updated_at: string
}

export interface APILessonRequest {
    author_id: string | null
    title: string
    content: string
    module_id: string
    is_premium: boolean
    publish: boolean
    order: number
}
