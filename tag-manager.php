<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Page\Collection;
use Grav\Common\Page\Page;

/**
 * Class TagManagerPlugin
 * @package Grav\Plugin
 */
class TagManagerPlugin extends Plugin
{
    protected $route = "tag-manager";

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100000], // TODO: Remove when plugin requires Grav >=1.7
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
    * Composer autoload.
    *is
    * @return ClassLoader
    */
    /*
    */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }
    
    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        if (!$this->isAdmin()) {
            return;
        }

        $this->enable([
            'onPagesInitialized' => ['onPagesInitialized', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onAdminMenu' => ['onAdminMenu', 0],
        ]);
    }

    public function onPagesInitialized() {
        $uri = $this->grav['uri'];

        if (strpos($uri->path(), $this->config->get('plugins.admin.route') . '/' . $this->route) === false) {
            return;
        }

        $twig = $this->grav['twig'];

        $twig->taxonomies = $this->config->get('site.taxonomies');

        $input = $uri->post();

        if (!empty($input) && array_key_exists('action', $input)) {
            if ($input['action'] === 'delete') {
                $tax = $input['tax'];
                $tag = $input['tag'];

                $page = $this->grav['page'];
                $collection = $page->evaluate(['@page.children' => '/blog', '@taxonomy.' . $tax => $tag]);

                foreach ($collection as $page) {
                    $taxonomy = $page->taxonomy();
                    $index = array_search($tag, $taxonomy[$tax]);
                    if ($index !== false) {
                        $taxonomy[$tax] = array_values(array_diff($taxonomy[$tax], [$tag]));
                        $page->taxonomy($taxonomy);
                        $header = $page->header();
                        $header->taxonomy = $taxonomy;
                        $page->header($header);
                        $page->save();
                        $twig->data = json_encode($page->header(), JSON_UNESCAPED_UNICODE);
                    }
                }

                $twig->done = ['action' => 'delete', 'target' => $tag];
            } elseif ($input['action'] = 'rename') {
                $tax = $input['tax'];
                $from = $input['from'];
                $to = $input['to'];

                $page = $this->grav['page'];
                $collection = $page->evaluate(['@page.children' => '/blog', '@taxonomy.' . $tax => $from]);

                foreach ($collection as $page) {
                    $taxonomy = $page->taxonomy();
                    $index = array_search($from, $taxonomy[$tax]);
                    if ($index !== false) {
                        $taxonomy[$tax][$index] = $to;
                        $page->taxonomy($taxonomy);
                        $header = $page->header();
                        $header->taxonomy = $taxonomy;
                        $page->header($header);
                        $page->save();
                        $twig->data = json_encode($page->header(), JSON_UNESCAPED_UNICODE);
                    }
                }

                $twig->done = ['action' => 'rename', 'from' => $from, 'to' => $to];
            }
        }
    }

    /**
     * Add plugin templates path
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/admin/templates';
    }

    public function onAdminMenu() {
        $this->grav['twig']->plugins_hooked_nav['PLUGIN_TAG_MANAGER.TAG_MANAGER'] = ['route' => $this->route, 'icon' => 'fa-tags'];
    }
}
