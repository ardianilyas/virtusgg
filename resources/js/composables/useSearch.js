import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "@/utils/debounce.js";

export function useSearch(initialSearch = '', delay = 600) {
    const query = ref(initialSearch);
    const debouncedSearch = debounce((newQuery) => {
        Inertia.get(route(route().current()), { search: newQuery }, {
            preserveState: true,
            replace: true,
        });
    }, delay)
    
    watch(query, (newQuery) => {
        debouncedSearch(newQuery);
    });
    
    return {
        query
    }
}