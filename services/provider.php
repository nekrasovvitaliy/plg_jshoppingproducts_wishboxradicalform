<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Jshoppingorder.Wishboxradicalform
 */
defined('_JEXEC') or die;

use \Joomla\CMS\Extension\PluginInterface;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Plugin\PluginHelper;
use \Joomla\DI\Container;
use \Joomla\DI\ServiceProviderInterface;
use \Joomla\Event\DispatcherInterface;
use \Joomla\Plugin\Jshoppingproducts\Wishboxradicalform\Extension\Wishboxradicalform;

return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   4.2.0
	 */
	public function register(Container $container)
	{
		$container->set
		(
			PluginInterface::class,
			function (Container $container)
			{
				$plugin = new Wishboxradicalform(
					$container->get(DispatcherInterface::class),
					(array)PluginHelper::getPlugin('jshoppingproducts', 'wishboxradicalform')
				);
				$plugin->setApplication(Factory::getApplication());
				return $plugin;
			}
		);
	}
};