console.log("it(); - запусти, тебе понравится!");
console.log("также попробуй - bruh();");

function it(){
    console.log("ура. послушай это...");
    document.write("I T  2");
    var audio = new Audio('sounds/verynicemusiciloveit.wav');
    audio.play();
}

function bruh(){
    var i = 0;
    var rnd = Math.floor(Math.random() * Math.floor(Math.floor(Math.random() * Math.floor(150))));
    while (i < rnd){ // change "100" to any number to depend the bruhs amount
        i++;
        document.write("BRUH ");
    }
}
