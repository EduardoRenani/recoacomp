<?php
	/**
	 * Interface para ações de cadastro e carregamento de dados do site, como usuários, arquivos...
	 * @category Sistema
	 * @package Interfaces
	 * @author Arthur Adolfo <arthur_adolfo@hotmail.com>
	 * @version 1.0
	 * @copyright StartU
	 */

	interface AcoesCadastroCarregamento {
		/**
	     * Define informações do objeto
	     * @param array dados da ser definido
	     * @throws InvalidArgumentException Uso de argumentos inválidos
	     */
		function setDados($dados);
		
		/**
		 * Salva dados no banco de dados as informações dos objetos
	     * @throws Exception Ocorreu erro
		 */
		function salvaDados();

		/**
	     * Retorna informações para cadastrar no DB as informações do objeto
	     * @return array dados
	     */
		function getDadosBanco();

		/**
	     * Retorna informações do objeto
	     * @return array dados
	     */
		function getDados();

		/**
	     * Valida dados do objeto
	     * @throws Exception caso ocorra erro
	     */
		function validaDados();
	}