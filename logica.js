var musica = new Audio('musica.mp3');

musica.play();

var botao = document.getElementById('btn').onclick = () => {
    
    musica.play();
    var aux = 0;

    var input = document.getElementById('input').value
    var sequencia = document.getElementById('sequencia');
    var resultado = document.getElementById('resultado');

    sequencia.innerHTML = "";



    var i = 0;
    var f1 = -1;
    var f2 = 1;
    var fibonacci = [];


    do {

        i = i + 1;
        var f3 = f1 + f2;
        f1 = f2;
        f2 = f3;

        fibonacci.push(f3);
        sequencia.innerHTML += `${f3}, `;


    } while (input >= f3)


    sequencia.setAttribute('style', 'display:visible');
    resultado.setAttribute('style', 'display:visible');


    for (var j = 0; j < fibonacci.length; j++) {
        if (fibonacci[j] == input) {
            var aux = 1;
            console.log("entrou")


        }
    }


    if (aux == 1) {
        resultado.style.color = 'green'
        resultado.innerHTML = `O número ${input} faz parte da sequência de Fibonacci.`
    } else {
        resultado.style.color = 'red'
        resultado.innerHTML = `O número ${input} não faz parte da sequência de Fibonacci.`
    }


}
