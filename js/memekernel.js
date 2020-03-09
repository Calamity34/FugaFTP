console.log("Инцилизация скрипта");
function GettingRMV(max) {
	console.log("Инцилизация функции GettingRMV. Рандомайзинг.");
	return Math.floor(Math.random() * Math.floor(max));
}
var a = GettingRMV(70);
console.warn(a);
function EndingRMV(){
	console.log("Инцилизация функции EndingRMV. Проверка данных.");
	var player = new Playerjs({id:"player", file:"memes/meme"+a+".mp4"});
	console.warn("1");
}
EndingRMV();