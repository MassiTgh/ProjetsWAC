import { MyWysiwyg } from './modules/myWysiwyg.js';
let mw = new MyWysiwyg(document.querySelector('textarea'), {
  buttons: ["bold", "italic", "color", "size", "barre", "link", "center", "align-left", "align-right", "justify", "increase-thickness", "reduce-thickness"]
});