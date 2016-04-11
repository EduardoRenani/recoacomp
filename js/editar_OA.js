    opacityModal = 0;
    tipoEdicao = null;
    function fadeInModal() {
        div = document.getElementById('modal');
        divDelete = document.getElementById('closeModal');
        divFundo = document.getElementsByClassName('fundoPreto')[0];
        divFundo.style.display = "block";
        divFundo.style.opacity = opacityModal;
        div.style.opacity = opacityModal;
        divDelete.style.opacity = opacityModal;
        opacityModal+=0.01;
        tModal = setTimeout(function() {fadeInModal()}, 1);
        if (opacityModal >= 1) {
            clearTimeout(tModal);
        }
    }

    function fadeOutModal() {
        div = document.getElementById('modal');
        div1 = document.getElementById('closeModal');
        divFundo = document.getElementsByClassName('fundoPreto')[0];
        document.getElementsByClassName('fundoPreto')[0].style.opacity = opacityModal;
        div1.style.opacity = opacityModal;
        div.style.opacity = opacityModal;
        opacityModal-=0.01;
        tFadeOutModal = setTimeout(function() {fadeOutModal()}, 1);
        if (opacityModal <= 0) {
            divFundo.style.display = "none";
            divDelete = document.getElementById('modal');
            divDelete.parentNode.removeChild(divDelete);
            divDeleteClose = document.getElementById('closeModal');
            divDeleteClose.parentNode.removeChild(divDeleteClose);
            clearInterval(window.tDeleteModal);
            clearTimeout(tFadeOutModal);
        }
    }

    function deleteModal() {
        if(document.getElementById('modal')) {
            if(document.getElementById('modal').contentDocument.getElementsByClassName('disciplinas-list').length != 0) {
                fadeOutModal();
                clearInterval(window.tDeleteModal);
            }
        }
    }

    function ShowModal(tipo, id) {

        modalClose = document.createElement('div');
        modalClose.setAttribute("id", "closeModal");
        modalClose.setAttribute("class", "text-right");
        modalClose.setAttribute("onclick", "fadeOutModal()");
        modalClose.setAttribute("style", "position: absolute; top: 12%; left: 0; font-size: 20px; background-color: ; z-index: 9999; width: 62%; padding-right: 33px;l");
        modalClose.innerHTML = '<a href="#"><span class="glyphicon glyphicon-remove"></span></a>';

        // Cria id do OA para colocar no modal
        oa = document.createElement('div');
        oa.setAttribute("id", id);
        oa.setAttribute("class", "idOA");
        

        modal = document.createElement("iframe");
        if (tipo == 'alterarNome'){
            modal.setAttribute("src", "views/editar_OA/modalNome.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 30%; background-color: #fff; width: 300px; height: 250px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar Nome';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            //Coloca o ID do objeto no documento
            document.getElementsByClassName('cadastrobase')[0].appendChild(oa);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarNome
        if (tipo == 'alterarDescricao'){
            modal.setAttribute("src", "views/editar_OA/modal.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar Descrição';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarDescricao
        if (tipo == 'alterarURL'){
            modal.setAttribute("src", "views/editar_OA/modal.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar URL';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarURL
        if (tipo == 'alterarPalavraChave'){
            modal.setAttribute("src", "views/editar_OA/modal.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar Palavra Chave';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarPalavraChave
        if (tipo == 'alterarIdioma'){
            modal.setAttribute("src", "views/editar_OA/modal.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar Idioma';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarURL
        if (tipo == 'alterarAConhecimento'){
            modal.setAttribute("src", "views/editar_OA/modal.php");
            modal.setAttribute("id", "modal");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");
            //adicionaTitulo(tipo);
            modal.setAttribute("onload", "this.contentDocument.getElementsByClassName('text-left')[0].innerHTML = 'Alterar Área de Conhecimento';");
            document.getElementsByClassName('fundoPreto')[0].appendChild(modal);

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        } // end alterarURL
        
    }

