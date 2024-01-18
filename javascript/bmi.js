function B() {
  const e = this.h.valueAsNumber,
    t = this.w.valueAsNumber,
    i = parseFloat(t / (e / 100) ** 2).toFixed(2),
    h = [
      [0, 18.49],
      [18.5, 24.99],
      [25, 29.99],
      [30, 34.99],
      [35, 39.99],
      [40, 100],
    ].findIndex((e) => e[0] <= i && i < e[1]);
  let o = (0.393700787 * e).toFixed(0);
  (this.ho.value = `${e} cm / ${Math.floor(o / 12)}' ${(o %= 12)}"`),
    (this.wo.value = `${t} kg / ${(2.2046 * t).toFixed(2)} lb`),
    (this.g[h].checked = !0),
    (this.r.value = i);
}
const bmi = document.querySelector(".c-bmi");
bmi.addEventListener("input", B);
bmi.dispatchEvent(new Event("input"));
