import { Ziggy } from './ziggy'; // Adjust the path if needed
import route from 'ziggy-js';

export default function useRoute(name, params = {}, absolute = true, customZiggy = Ziggy) {
    return route(name, params, absolute, customZiggy);
}
