function showScene(sceneNumber) {
  for (let i = 1; i <= 5; i++) {
    const scene = document.getElementById(`scene-${i}`);
    const btn = document.querySelector(`.btn-${i}`);

    if (i === sceneNumber) {
      scene.style.display = "block";
    } else {
      scene.style.display = "none";
    }
  }
}

for (let i = 1; i <= 5; i++) {
  const btn = document.querySelector(`.btn-${i}`);
  btn.addEventListener("click", function () {
    showScene(i);
  });
}

showScene(1);
