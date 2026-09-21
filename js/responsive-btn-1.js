const buttons = document.querySelectorAll(".prism");
let center = vec2.fromValues(innerWidth * 0.5, innerHeight * 0.5);
let mousePos = vec2.clone(center);
const minDist = 0;
const maxDist = 400;
const minOffset = 0;
const maxOffset = 25;
const rotationalScale = 1;
const TAU = Math.PI * 2;

function handleMouseMove(event) {
  vec2.set(mousePos, event.clientX, event.clientY);
  const angle = mousePos[0] * mousePos[1] * 0.00005;
  
  // Get the distance of each button to the mouse
  buttons.forEach(button => {
    const rect = button.getBoundingClientRect();
    if(isOnScreen(rect)) {
      const buttonCenter = vec2.fromValues(
        rect.left + (rect.right - rect.left) * 0.5,
        rect.top + (rect.bottom - rect.top) * 0.5,
      );
      const distValue = vec2.dist(buttonCenter, mousePos);
      const dist = clamp(distValue, minDist, maxDist);
      const offset = map(maxDist - dist, minDist, maxDist, maxOffset, minOffset);
      const intensity = map(maxDist - dist, 0, maxDist, 0, 1);
      button.style.setProperty('--intensity', intensity * intensity);
      const scaleFactor = map(maxDist - dist, 0, maxDist, 1.01, 1.05);
      const offsetCorrection = map(maxDist - dist, 0, maxDist, 0, maxOffset * 0.5);
      button.style.setProperty('--scaleFactor', scaleFactor);
      const blur = map(dist, 0, maxDist, 5, 50);
      button.style.setProperty('--blur', blur);
      
      const redTopValue = Math.sin((angle + 0) * rotationalScale) * offset - offsetCorrection * -0.19;
      const redLeftValue = Math.cos((angle + 0) * rotationalScale) * offset - offsetCorrection;
      button.style.setProperty('--redTop', redTopValue);
      button.style.setProperty('--redLeft', redLeftValue);
      
      const greenTopValue = Math.sin((angle + 2) * rotationalScale) * offset - offsetCorrection * 0.5;
      const greenLeftValue = Math.cos((angle + 2) * rotationalScale) * offset - offsetCorrection * 0.5;
      button.style.setProperty('--greenTop', greenTopValue);
      button.style.setProperty('--greenLeft', greenLeftValue);
      
      const blueTopValue = Math.sin((angle + 4) * rotationalScale) * offset - offsetCorrection;
      const blueLeftValue = Math.cos((angle + 4) * rotationalScale) * offset - offsetCorrection;
      button.style.setProperty('--blueTop', blueTopValue);
      button.style.setProperty('--blueLeft', blueLeftValue);
    }
  });
  
}
addEventListener("mousemove", throttled(handleMouseMove));

function handleResize() {
  vec2.set(center, innerWidth * 0.5, innerHeight * 0.5);
}
addEventListener("resize", throttled(handleResize));

function init() {
  buttons.forEach(button => {
    button.innerHTML = `<span class='red'></span><span class='green'></span><span class='blue'></span>${button.innerHTML}`;
  });
}
init();

// USEFUL FUNCTIONS -----------------
function throttled(fn) {
  let didRequest = false;
  return param => {
    if (!didRequest) {
      window.requestAnimationFrame(() => {
        fn(param);
        didRequest = false;
      });
      didRequest = true;
    }
  };
}
function isOnScreen(rect) {
   return rect.top < window.innerHeight && rect.bottom > 0;
}
function clamp(value, min = 0, max = 1) {
  return value <= min ? min : value >= max ? max : value;
}
function map(value, min1, max1, min2, max2) {
  return (value - min1) * (max2 - min2) / (max1 - min1) + min2;
}