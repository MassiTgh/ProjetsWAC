export class MyWysiwyg {
  constructor(textarea, options) {
    // set les arguments
    this.textarea = textarea;
    this.buttons = options.buttons;
    // création des boutons quand la classe est instanciée par le tester.js
    this.createButtons();
    window.onload = this.reload();
    // tentative de fonction quand la page se ferme mais ne fonctionne pas, why ?
    // window.onbeforeunload = this.onclose();
  }
  save() {
    const minute = 1;
    let select = window.getSelection().toString();
    // Permet d'afficher le texte sélectionné
    // mais je n'arrive pas à le modifier, why ?
    console.log(select);
    localStorage.setItem("save", select);
    // const cat = localStorage.getItem('save');
    // console.log(cat);
    setInterval(this.save, minute * 60000);
  }
  reload() {
    const cat = localStorage.getItem("save");
    // console.log(cat);
    this.textarea.value = cat;
  }
  createButtons() {
    // permettra d'éviter que l'affichage des boutons ajoutés se répète
    let isColor = true;
    let isSize = true;
    let isLink = true;
    this.buttons.forEach(buttonName => {
      const buttonOption = document.createElement("button");
      buttonOption.textContent = buttonName;

      // créer les boutons avant la textarea
      this.textarea.insertAdjacentElement("beforebegin", buttonOption);
      buttonOption.addEventListener("click", () => {
        this.save();
        if (buttonOption.textContent == "italic") {
          this.textarea.classList.toggle("italic");
        } else if (buttonOption.textContent == "bold") {
          this.textarea.classList.toggle("bold");
        } else if (buttonOption.textContent == "color") {
          const red = document.createElement("button");
          const blue = document.createElement("button");
          const green = document.createElement("button");
          const yellow = document.createElement("button");
          const black = document.createElement("button");
          red.textContent = "red";
          blue.textContent = "blue";
          green.textContent = "green";
          yellow.textContent = "yellow";
          black.textContent = "black";
          if (isColor) {
            buttonOption.insertAdjacentElement("beforebegin", red);
            buttonOption.insertAdjacentElement("beforebegin", blue);
            buttonOption.insertAdjacentElement("beforebegin", green);
            buttonOption.insertAdjacentElement("beforebegin", yellow);
            buttonOption.insertAdjacentElement("beforebegin", black);
            isColor = false;
          } else if (isColor == false) {
            // fonctionne pas, why ?
            // si je veux supprimer le color je peux mais pas les couleurs
            red.remove();
          }

          // pas d'utilisation de toggle sinon ça fait bug les couleurs
          // entre elles (à moins de cliquer 2x sur la couleur à chaque fois
          // pour l'enlever et cliquer ensuite sur une autre)
          red.addEventListener("click", () => {
            this.textarea.style.color = "red";
          });
          blue.addEventListener("click", () => {
            this.textarea.style.color = "blue";
          });
          green.addEventListener("click", () => {
            this.textarea.style.color = "green";
          });
          yellow.addEventListener("click", () => {
            this.textarea.style.color = "yellow";
          });
          black.addEventListener("click", () => {
            this.textarea.style.color = "black";
          });
        } else if (buttonOption.textContent == "size") {
          let size = window.getComputedStyle(this.textarea).fontSize;
          size = parseInt(size);
          const sizeUp = document.createElement("button");
          const sizeDown = document.createElement("button");
          sizeUp.textContent = "Up size";
          sizeDown.textContent = "Down size";
          if (isSize) {
            buttonOption.insertAdjacentElement("beforebegin", sizeUp);
            buttonOption.insertAdjacentElement("beforebegin", sizeDown);
            isSize = false;
          }
          sizeUp.addEventListener("click", () => {
            size += 1;
            this.textarea.style.fontSize = size + "px";
          });
          sizeDown.addEventListener("click", () => {
            size -= 1;
            this.textarea.style.fontSize = size + "px";
          });
        } else if (buttonOption.textContent == "barre") {
          this.textarea.classList.toggle("text_barre");
        } else if (buttonOption.textContent == "center") {
          this.textarea.style.textAlign = "center";
        } else if (buttonOption.textContent == "align-right") {
          this.textarea.style.textAlign = "right";
        } else if (buttonOption.textContent == "align-left") {
          this.textarea.style.textAlign = "left";
        } else if (buttonOption.textContent == "justify") {
          this.textarea.style.textAlign = "justify";
          this.textarea.classList.toggle("text_justify");
        } else if (buttonOption.textContent == "link") {
          const inputLink = document.createElement("input");
          if (isLink) {
            buttonOption.insertAdjacentElement("beforebegin", inputLink);
            isLink = false;
          }
          inputLink.type = "file";
        } else if (buttonOption.textContent == "increase-thickness") {
          let size = window.getComputedStyle(this.textarea).borderWidth;
          size = parseInt(size);
          size += 1;
          this.textarea.style.borderWidth = size + "px";
        } else if (buttonOption.textContent == "reduce-thickness") {
          let size = window.getComputedStyle(this.textarea).borderWidth;
          size = parseInt(size);
          if (size > 1) {
            size -= 1;
          }
          this.textarea.style.borderWidth = size + "px";
        }
      });
    });
  }
}