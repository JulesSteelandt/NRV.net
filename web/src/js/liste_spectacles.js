import {url} from "./url.js";
import {loadRessource} from "./loader.js";

export function load() {
    return loadRessource(url + "/programme").then(data => {
        return data.data;
    });
}