<style>
.tooltip {
	width: 15px;
	height: 15px;
	text-align: center;
	line-height: 15px;
	border-radius: 15px;
	color: #108AC0;
	border: 1px solid #108AC0;
}

.mensagemTooltip {
	position: relative;
	top: -35px;
	left: 30px;
	width: 200px;
	height: 50px;
	background-color: rgba(40, 120, 200, 0.4);
	color: rgba(40, 120, 200, 0.4);
	border: 1px solid #108AC0;
	border-radius: 10px;
}
</style>

<script language="javascript">
opacityTip = 0;
	function toolTip(id) {
		div = document.getElementsByClassName('tooltip')[id-1];
		tooltip = document.createElement('div');
		tooltip.setAttribute('class', 'mensagemTooltip');
		div.appendChild(tooltip);
		opacityTip = 0;
		fadeInTip(id);
	}
	function deleteTooltip(id) {
		opacityTip = 1;
		fadeOutTip(id);
	}
	function fadeInTip(id) {
		div = document.getElementsByClassName('tooltip')[id-1].lastChild;
		div.style.opacity = opacityTip;
		opacityTip+=0.1;
		tTip = setTimeout(function() {fadeInTip(id)}, 10);
		if (opacityTip >= 1) {
			clearTimeout(tTip);
		}
	}
	function fadeOutTip(id) {
		div = document.getElementsByClassName('tooltip')[id-1].lastChild;
		div.style.opacity = opacityTip;
		opacityTip-=0.1;
		tTip1 = setTimeout(function() {fadeOutTip(id)}, 10);
		if (opacityTip <= 0) {
			div = document.getElementsByClassName('tooltip')[id-1];
			div.removeChild(div.lastChild);
			clearTimeout(tTip1);
		}
	}
</script>
<br><br><br>
<div class="tooltip"><div onmouseover="toolTip(1)" onmouseout="deleteTooltip(1)">?</div></div>
<br>
<div class="tooltip"><div onmouseover="toolTip(2)" onmouseout="deleteTooltip(2)">?</div></div>
<br>
<div class="tooltip"><div onmouseover="toolTip(3)" onmouseout="deleteTooltip(3)">?</div></div>
<br>
<div class="tooltip"><div onmouseover="toolTip(4)" onmouseout="deleteTooltip(4)">?</div></div>