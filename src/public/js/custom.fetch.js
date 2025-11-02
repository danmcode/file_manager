import { showLoader, hideLoader } from './loader.js';

/**
 * Fetch reutilizable con manejo de errores y loader
 * @param {string} url - Endpoint o ruta
 * @param {object} options - Opciones fetch (method, body, headers, etc.)
 * @returns {Promise<any>} - JSON o error
 */
export async function customFetch(url, options = {}) {
    try {
        showLoader();

        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                ...options.headers,
            },
            ...options,
        });

        if (!response.ok) throw new Error(`Error: ${response.status}`);

        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Fetch error:', error);
        return null;
    } finally {
        hideLoader();
    }
}
