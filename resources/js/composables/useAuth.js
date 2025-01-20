import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export function useAuth() {
    const page = usePage();

    const user = computed(() => page.props.value.auth.user);

    const isAuthenticated = computed(() => user.value !== null);

    return {
        user,
        isAuthenticated,
    };
}
