import {display_soiree, display_spectacles} from "./liste_spectacles_ui.js";
import {load, loadSoiree} from "./liste_spectacles.js";

display_spectacles(load());
// display_soiree(loadSoiree("/soiree/29"));