console.log("ono(); - запусти, тебе понравится!");
console.log("также попробуй - bruh()");

function ono(){
console.log("ура. послушай это...");
var audio = new Audio('sounds/verynicemusiciloveit.wav');
audio.play();
}

function bruh(){
    var i = 0;
    while (i<100){ // change "100" to any number to depend the bruhs amount
        i++;
        document.write("BRUH ");
    }
}
