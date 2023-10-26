export function loadRessource(uri) {
    return fetch(uri)
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            else {
                return Promise.reject(new Error(response.statusText));
            }
        });
}