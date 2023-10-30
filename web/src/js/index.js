import {display_soiree, display_spectacles} from "./liste_spectacles_ui.js";
import {load, loadSoiree} from "./liste_spectacles.js";



//si page d'accueil alors afficher les spectacles
//si page soiree alors afficher la soiree


display_spectacles(load());

//display_soiree(loadSoiree("/soiree/29"));