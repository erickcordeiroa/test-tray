import { defineStore } from 'pinia';

type User = {
    name: string;
    email: string;
    birthdate?: string | null;
    document?: string | null;
    token: string;
}

export const useUserStore = defineStore('user', {
    state: () => ({
        name: '',
        email: '',
        birthdate: null as string | null,
        document: null as string | null,
        token: '',
    }),
    actions: {
        setUser(userData: User) {
            this.name = userData.name;
            this.email = userData.email;
            this.birthdate = userData.birthdate ?? null;
            this.document = userData.document ?? null;
            this.token = userData.token;
        },
    },
});