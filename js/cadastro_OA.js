function toolTip(id, texto) {
    div = document.getElementsByClassName('tooltiploco')[id-1];
    tooltip = document.createElement('div');
    tooltip.setAttribute('class', 'mensagemTooltiploco');
    tooltip.innerHTML = texto;
    div1 = document.createElement('div');
    div1.style.width = "200px";
    div1.appendChild(tooltip);
    div.appendChild(div1);
    opacityTip = 0;
    fadeInTip(id);
}
