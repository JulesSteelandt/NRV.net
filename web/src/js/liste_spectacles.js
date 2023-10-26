import {url} from "./url.js";
import {loadRessource} from "./loader.js";

export function load() {
    return loadRessource(url + "/spectacle/1").then(data => {
        return data.data;
    });
}