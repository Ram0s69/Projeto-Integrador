document.getElementById("equationForm").addEventListener("submit", function (event) {
  event.preventDefault();
  calcularEquacao();
});

document.getElementById("equationForm").addEventListener("reset", function () {
  document.getElementById("result").innerHTML = "";
});

function calcularEquacao() {
  var tipoEquacao = parseInt(document.getElementById("equacao").value);
  var coeficienteA = parseFloat(document.getElementById("coefficientA").value);
  var coeficienteB = parseFloat(document.getElementById("coefficientB").value);

  switch (tipoEquacao) {
    case 1:
      resolverEquacaoPrimeiroGrau(coeficienteA, coeficienteB);
      break;
    case 2:
      var coeficienteC = parseFloat(document.getElementById("coefficientC").value);
      resolverEquacaoSegundoGrau(coeficienteA, coeficienteB, coeficienteC);
      break;
    case 3:
      var coeficienteD = parseFloat(document.getElementById("coefficientD").value);
      resolverEquacaoCubica(coeficienteA, coeficienteB, coeficienteC, coeficienteD);
      break;
    default:
      document.getElementById("result").innerHTML = "Selecione um tipo de equação válido.";
      break;
  }
}

function resolverEquacaoPrimeiroGrau(coeficienteA, coeficienteB) {
  if (coeficienteA === 0) {
    document.getElementById("result").innerHTML = "Não é uma equação de primeiro grau válida.";
  } else {
    var solucao = -coeficienteB / coeficienteA;
    document.getElementById("result").innerHTML = "A solução é: " + solucao;
  }
}

function resolverEquacaoSegundoGrau(coeficienteA, coeficienteB, coeficienteC) {
  var discriminante = coeficienteB ** 2 - 4 * coeficienteA * coeficienteC;

  if (discriminante > 0) {
    var solucao1 = (-coeficienteB + Math.sqrt(discriminante)) / (2 * coeficienteA);
    var solucao2 = (-coeficienteB - Math.sqrt(discriminante)) / (2 * coeficienteA);
    document.getElementById("result").innerHTML = "As soluções são: <br>" + solucao1 + "e<br>" + solucao2;
  } else if (discriminante === 0) {
    var solucao = -coeficienteB / (2 * coeficienteA);
    document.getElementById("result").innerHTML = "A solução é: " + solucao;
  } else {
    document.getElementById("result").innerHTML = "A equação não possui solução real.";
  }
}

function resolverEquacaoCubica(coeficienteA, coeficienteB, coeficienteC, coeficienteD) {
  if (coeficienteA === 0) {
    document.getElementById("result").innerHTML = "Não é uma equação cúbica válida.";
  } else {
    var delta0 = coeficienteB * coeficienteB - 3 * coeficienteA * coeficienteC;
    var delta1 = 2 * coeficienteB * coeficienteB * coeficienteB - 9 * coeficienteA * coeficienteB * coeficienteC + 27 * coeficienteA * coeficienteA * coeficienteD;
    var C = Math.cbrt((delta1 + Math.sqrt(delta1 * delta1 - 4 * delta0 * delta0 * delta0)) / 2);
    var x1 = (-1 * coeficienteB - C - (delta0 / C)) / (3 * coeficienteA);
    var x2 = (-1 * coeficienteB + (0.5 * (C + Math.sqrt(3) * Math.sqrt(-1 * C * C - 4 * delta0) / C))) / (3 * coeficienteA);
    var x3 = (-1 * coeficienteB + (0.5 * (C - Math.sqrt(3) * Math.sqrt(-1 * C * C - 4 * delta0) / C))) / (3 * coeficienteA);

    document.getElementById("result").innerHTML = "As soluções são: <br>" + x1 + ", <br>" + x2 + ", <br>" + x3;
  }
}
