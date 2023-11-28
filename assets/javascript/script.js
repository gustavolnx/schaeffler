// Obtém referências para os elementos DOM relevantes
// Selecione os botões e as cenas usando seus IDs
var btn1 = document.getElementById("btn-1");
var btn3 = document.getElementById("btn-3");
var scene2 = document.getElementById("scene-2");
var scene3 = document.getElementById("scene-3");

// Adicione um ouvinte de evento de clique ao btn-1
btn1.addEventListener("click", function () {
  // Exibe a scene-2 ao clicar no btn-1
  scene2.style.display = "block";

  // Oculta a scene-3 se estiver visível
  if (scene3.style.display !== "none") {
    scene3.style.display = "none";
  }
});

// Adicione um ouvinte de evento de clique ao btn-3
btn3.addEventListener("click", function () {
  // Exibe a scene-3 ao clicar no btn-3
  scene3.style.display = "block";

  // Oculta a scene-2 se estiver visível
  if (scene2.style.display !== "none") {
    scene2.style.display = "none";
  }
});
