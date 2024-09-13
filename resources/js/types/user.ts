export type UserType = 'admin' | 'dev' | 'author' | 'student'

export interface APIUser {
    id: string
    name: string
    email: string
    email_verified_at: string | null
    type: UserType
    created_at: string
    updated_at: string
    deleted_at: string | null
}
