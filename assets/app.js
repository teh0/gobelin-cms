/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.styl';
import Choices from "choices.js";
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/app.js');


class App {
    constructor() {
        this.categories = document.getElementById('page_entity_categories')
        this.tags = document.getElementById('page_entity_tags')
        this.init()
    }

    init(){
        this.form()
    }

    form(){
        let categories = new Choices(this.categories,{
            searchEnabled: false,
            itemSelectText: '',
            classNames: {
                containerOuter: 'choices select-choices',
            },
            removeItemButton: true,
        })
        let tags = new Choices(this.tags,{
            searchEnabled: false,
            itemSelectText: '',
            classNames: {
                containerOuter: 'choices select-choices',
            },
            removeItemButton: true,
        })
    }
}

const app = new App()
// let categories = new Choices('#page_entity_categories', {
//     searchEnabled: false,
//     itemSelectText: '',
//     classNames: {
//         containerOuter: 'choices select-choices',
//     },
//     removeItemButton: true,
// });
