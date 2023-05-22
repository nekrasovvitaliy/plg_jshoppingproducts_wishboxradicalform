<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  Jshoppingproducts.Wishboxoneclickorder
 */
namespace Joomla\Plugin\Jshoppingproducts\Wishboxradicalform\Extension;

use \Exception;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Plugin\CMSPlugin;
use \Joomla\Event\DispatcherInterface;
use \Joomla\Event\Event;
use \Joomla\Event\SubscriberInterface;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

if (!file_exists(JPATH_SITE.'/components/com_jshopping/bootstrap.php')) {
	\JSError::raiseError(500, "Please install component \"joomshopping\"");
}
require_once (JPATH_SITE.'/components/com_jshopping/bootstrap.php');

/**
 *
 */
final class Wishboxradicalform extends \WishBox\JShoppingPlugin implements SubscriberInterface
{
	/**
	 * Autoload the language file.
	 *
	 * @var boolean
	 * @since 4.1.0
	 */
	protected $autoloadLanguage = true;
	
	
	/**
	 * @inheritDoc
	 *
	 * @return string[]
	 *
	 * @since 4.1.0
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeDisplayProductView'		=> 'onBeforeDisplayProductView'
		];
	}

	/**
	 * Constructor.
	 *
	 * @param   DispatcherInterface  $dispatcher  The dispatcher
	 * @param   array                $config      An optional associative array of configuration settings
	 *
	 * @since   1.0.0
	 */
	public function __construct(DispatcherInterface $dispatcher, array $config)
	{
		parent::__construct($dispatcher, $config);
	}
	
	/**
	 *
	 */
	public function onBeforeDisplayProductView(Event $event)
	{
		$productPosition = $this->params->get('product_position', '_tmp_product_html_buttons');
		$view = $event->getArgument(0);
		$view->$productPosition .= $this->getRenderer('button')->render();
		$displayData = [
			'product' => $view->product
		];
		$view->_tmp_product_html_end .= HTMLHelper::_(
			'bootstrap.renderModal',
			'wishboxradicalform',
			[
				'title'			=> Text::_('PLG_JSHOPPINGPRODUCTS_WISHBOXRADICALFORM_MODAL_HEADER'),
				'bodyHeight'	=> 70
			],
			$this->getRenderer('modal')->render($displayData)
		);
		$event->setArgument(0, $view);
	}
}