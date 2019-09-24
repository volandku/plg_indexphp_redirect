<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Ws_Txtredirect
 * @since       2.5+
 * @author		Sergey Bolotov
 */
class plgSystemWs_indexphpredirect extends JPlugin
{
	/**
	 * Class Constructor
	 * @param object $subject
	 * @param array $config
	 */
	public function __construct( & $subject, $config )
	{
		parent::__construct( $subject, $config );
		$this->loadLanguage();
	}

	public function onAfterRoute()
	{
		// self::followRulesCSV();
		$uri     = JUri::getInstance();
		$current = rawurldecode($uri->toString(array('scheme', 'host', 'path', 'query', 'fragment')));
		$scheme=$uri->toString(array('scheme'));

		if ($scheme=="http://")
		{
			// Подумываем про редирект
			$redirect=TRUE;
			// if (!(strpos($uri->toString(array('host')),'localhost')===FALSE)) $redirect=FALSE;
			if (!(strpos($uri->toString(array('query')),'js_paymentclass')===FALSE)) $redirect=FALSE;
			if (!(strpos($uri->toString(array('query')),'checkout'))===FALSE) $redirect=FALSE;
			if (!(strpos($uri->toString(array('path')),'checkout')===FALSE)) $redirect=FALSE;
			if (!(strpos($uri->toString(array('path')),'administrator')===FALSE)) $redirect=FALSE;

			if ($redirect)
			{
				if (strpos($current,'index.php/')!==FALSE)
				{
                    $app = JFactory::getApplication();
                    $app->redirect(str_replace('index.php/','',$current));
                    exit();
                }

			}

		}

	}


}
