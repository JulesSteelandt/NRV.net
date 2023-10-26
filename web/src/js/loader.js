export function loadRessource(uri) {
    return fetch(uri, {
        credentials: "include"
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            else {
                return Promise.reject(new Error(response.statusText));
            }
        });
}