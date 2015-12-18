    opacityTip = 0;
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
    function deleteTooltip(id) {
        opacityTip = 1;
        fadeOutTip(id);
    }
    function fadeInTip(id) {
        div = document.getElementsByClassName('tooltiploco')[id-1].lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip+=0.1;
        tTip = setTimeout(function() {fadeInTip(id)}, 10);
        if (opacityTip >= 1) {
            clearTimeout(tTip);
        }
    }
    function fadeOutTip(id) {
        div = document.getElementsByClassName('tooltiploco')[id-1].lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip-=0.1;
        tTip1 = setTimeout(function() {fadeOutTip(id)}, 10);
        if (opacityTip <= 0) {
            div = document.getElementsByClassName('tooltiploco')[id-1];
            div.removeChild(div.lastChild);
            clearTimeout(tTip1);
        }
    }

//tooltip para competencias
    function toolTipComp(id, texto) {
		$( ".mensagemTooltiploco" ).remove();
        div = document.getElementById(id);
        tooltip = document.createElement('div');
        tooltip.setAttribute('class', 'mensagemTooltiploco');
        tooltip.innerHTML = texto;
        div1 = document.createElement('div');
        div1.style.width = "200px";
        div1.appendChild(tooltip);
        div.appendChild(div1);
        opacityTip = 0;
        fadeInTipComp(id);
    }
    function deleteTooltipComp(id) {
        opacityTip = 1;
        fadeOutTipComp(id);
    }
    function fadeInTipComp(id) {
        div = document.getElementById(id).lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip+=0.1;
        tTipInComp = setTimeout(function() {fadeInTipComp(id)}, 10);
        if (opacityTip >= 1) {
            clearTimeout(tTipInComp);
        }
    }
    function fadeOutTipComp(id) {
        div = document.getElementById(id).lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip-=0.1;
        tTipOutComp = setTimeout(function() {fadeOutTipComp(id)}, 10);
        if (opacityTip <= 0) {
            div = document.getElementById(id);
            div.removeChild(div.lastChild);
            clearTimeout(tTipOutComp);
        }
    }

    //tooltip para sortable
    function toolTipSortable(id, texto) {
		$( ".mensagemTooltipSortable" ).remove();
        div = document.getElementById("tabela1");
        tooltip = document.createElement('div');
        tooltip.setAttribute('class', 'mensagemTooltipSortable');
        tooltip.innerHTML = texto;
        fecharTooltip = document.createElement('div');
        fecharTooltip.setAttribute('style', 'position: relative; cursor: pointer; padding-top: 1px; padding-left: 5px; width: 20px; height: 20px; border-radius: 25px; background-color: #fff; color: #000; float: right;');
        fecharTooltip.setAttribute('onclick', 'deleteToolTipSortable("tabela1");');
        fecharTooltip.innerHTML = "X";
        tooltip.appendChild(fecharTooltip);
        div.parentNode.appendChild(tooltip);
        opacityTip = 0;
        fadeInTipSortable(id);
    }
    function deleteToolTipSortable(id) {
        opacityTip = 1;
        fadeOutTipSortable(id);
    }
    function fadeInTipSortable(id) {
        div = document.getElementById("tabela1").parentNode.lastChild;
        div.style.opacity = opacityTip;
        opacityTip+=0.1;
        tTipInSortable = setTimeout(function() {fadeInTipSortable(id)}, 10);
        if (opacityTip >= 1) {
            clearTimeout(tTipInSortable);
        }
    }
    function fadeOutTipSortable(id) {
        div = document.getElementById(id).parentNode.lastChild;
        div.style.opacity = opacityTip;
        opacityTip-=0.1;
        tTipOutSortable = setTimeout(function() {fadeOutTipSortable(id)}, 10);
        if (opacityTip <= 0) {
            div = document.getElementById(id).parentNode;
            div.removeChild(div.lastChild);
            clearTimeout(tTipOutSortable);
        }
    }

//tooltip para competencias
    function toolTipCHA(id, CHA) {
        div = document.getElementById(id);
        tooltip = document.createElement('div');
        tooltip.setAttribute('class', 'mensagemTooltiploco');
        tooltip.innerHTML = $("#"+CHA+"Descricao").val().replace(/\,/g, "<br>");
        div1 = document.createElement('div');
        div1.style.width = "200px";
        div1.appendChild(tooltip);
        div.appendChild(div1);
        opacityTip = 0;
        fadeInTipCHA(id);
    }
    function deleteTooltipCHA(id) {
        opacityTip = 1;
        fadeOutTipCHA(id);
    }
    function fadeInTipCHA(id) {
        div = document.getElementById(id).lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip+=0.1;
        tTipInCHA = setTimeout(function() {fadeInTipCHA(id)}, 10);
        if (opacityTip >= 1) {
            clearTimeout(tTipInCHA);
        }
    }
    function fadeOutTipCHA(id) {
        div = document.getElementById(id).lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip-=0.1;
        tTipOutCHA = setTimeout(function() {fadeOutTipCHA(id)}, 10);
        if (opacityTip <= 0) {
            div = document.getElementById(id);
            div.removeChild(div.lastChild);
            clearTimeout(tTipOutCHA);
        }
    }