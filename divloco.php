<style>
#janela {
	width: 650px;
	min-height: 400px;
	overflow-x: hidden;
}

#menu {
	float: left;
	width: 100%;
	height: 44px;
	background-color: #f1f1f2;
}

#menudiv {
	float: left;
	width: 31.3%;
	height: 100%;
	text-align: center;
}

#seta {
	float: left;
	width: 3%;
	height: 100%;
}

.seta-active {
	background: url("img/arrow.png") no-repeat;
	background-size: 84%;
	background-clip: content-box;	
}

.active {
	background-color: #108AC0;
}

#conteudo {
	width: 650px;
	min-height: 356px;
	overflow-x: hidden;
}

#sub-conteudo {
	position: relative;
	float: left;
	width: 650px;
	min-height: 356px;
}

#sub-conteudo1 {
	position: relative;
	float: left;
	width: 650px;
	min-height: 356px;
}

#sub-conteudo2 {
	position: relative;
	float: left;
	width: 650px;
	min-height: 356px;
}

.tab {
	display: none;
}

.tab-active {
	display: block;
}
</style>
<script language="javascript">
	function mudaTab(qualTab) {
		if(qualTab == 1) {
			divTab = document.getElementById('sub-conteudo');
			divTab.removeAttribute('class');
			divTab.setAttribute('class', 'tab');
			divTab = document.getElementById('sub-conteudo1');
			divTab.removeAttribute('class');
			divTab.setAttribute('class', 'tab-active');
			divTab = document.getElementById('menu');
			divTab.childNodes[qualTab].removeAttribute('class');
			divTab.childNodes[qualTab].setAttribute('class', 'active');
			divTab.childNodes[qualTab+1].removeAttribute('class');
			divTab.childNodes[qualTab+1].setAttribute('class', 'active');
			divTab.childNodes[qualTab+2].removeAttribute('class');
			divTab.childNodes[qualTab+2].setAttribute('class', 'seta-active');
		}
		else if(qualTab == 2) {
			divTab = document.getElementById('sub-conteudo1');
			divTab.removeAttribute('class');
			divTab.setAttribute('class', 'tab');
			divTab = document.getElementById('sub-conteudo2');
			divTab.removeAttribute('class');
			divTab.setAttribute('class', 'tab-active');
			divTab = document.getElementById('menu');
			divTab.childNodes[qualTab+1].removeAttribute('class');
			divTab.childNodes[qualTab+1].setAttribute('class', 'active');
			divTab.childNodes[qualTab+2].removeAttribute('class');
			divTab.childNodes[qualTab+2].setAttribute('class', 'active');
			divTab.childNodes[qualTab+3].removeAttribute('class');
			divTab.childNodes[qualTab+3].setAttribute('class', 'active');
		}
	}
</script>
<div id="janela">
	<div id="menu">
		<div id="menudiv" class="active"><?php echo WORDING_GENERAL_INFORMATION; ?></div>
		<div id="seta" class="seta-active"></div>
		<div id="menudiv1"><?php echo WORDING_LIFE_CATEGORY; ?></div>
		<div id="seta1"></div>
		<div id="menudiv2"><?php echo WORDING_TECHNICAL_CATEGORY; ?></div>
		<div id="seta2"></div>
		<div id="menudiv3"><?php echo WORDING_EDUCATIONAL_CATEGORY; ?></div>
		<div id="seta3"></div>
		<div id="menudiv4"><?php echo WORDING_RIGHT_CATEGORY; ?></div>
		<div id="seta4"></div>
		<div id="menudiv5"><?php echo WORDING_ASSOCIATE_COMPETENCE; ?></div>
		</div>
	<div id="conteudo">
		<div id="sub-conteudo" class="tab-active">
			conteudo loco
			<div id="botao">
				<input onclick="mudaTab(1)" type="submit" value="clique aqui se tu é louco">
			</div>
		</div>
		<div id="sub-conteudo1" class="tab">
			conteudo locaço
			<div id="botao">
				<input onclick="mudaTab(2)" type="submit" value="clique aqui se tu é louco">
			</div>
		</div>
		<div id="sub-conteudo2" class="tab">
			conteudo loucão
			<div id="botao">
				
			</div>
		</div>
	</div>
</div>