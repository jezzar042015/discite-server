import { useUserStore } from "@/stores/user";

export const canBrowseGuard = async (to: any, from: any, next: any) => {
    const auth = useUserStore();

    if (!auth.current) await auth.getCurrent()

    if (!auth.canBrowse) {
        next('/dashboard');
    } else {
        next();
    }
};

export const isAdminGuard = async (to: any, from: any, next: any) => {
    const auth = useUserStore();
    
    if (!auth.current) await auth.getCurrent()

    if (!auth.isAdmin) {
        next('/dashboard');
    } else {
        next();
    }
};