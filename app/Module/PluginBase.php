<?php
namespace App\Module;

use Illuminate\Contracts\Foundation\Application;

abstract class PluginBase
{
    protected $app;

    /**
     * The Plugin Name.
     *
     * @var string
     */
    public $name;


    /**
     * The Plugin Slug
     *
     * @var string
     */

    public $slug;

    /**
     * Plugin website or landing page
     *
     * @var string
     */

    public $url;

    /**
     * A description of the plugin.
     *
     * @var string
     */
    public $description;

    /**
     * Plugin Owner name
     *
     * @var string
     */

    public $author;

    /**
     * Plugin owner url
     *
     * @var string
     */

    public $author_url;


    /**
     * The version of the plugin.
     *
     * @var string
     */
    public $version;

    /**
     * @var string
     *
     * This is the min version of Udify. You must have to min this version of Udify in order to use the plugin.
     */

    public $lms_version = '1.0.0';

    public $view_namespace = null;
    /**
     * @var string
     *
     * Get plugin directory Name
     */
    public $basename;

    /**
     * @var bool
     *
     * Determine if plugin is activated
     */

    public $activated = false;


    /**
     * @var $this
     */
    private $reflector = null;

    /**
     * Plugin constructor.
     *
     * @param $app
     */
    public function __construct(Application $app){
        $this->app = $app;

        $this->checkPluginName();


        $this->basename = basename($this->getPluginPath());

        $active_plugins = (array) json_decode(get_option('active_plugins'), true);
        $this->activated = in_array($this->basename, $active_plugins);
    }

    abstract public function boot();

    /**
     * Check for empty plugin name.
     *
     * @throws \InvalidArgumentException
     */
    private function checkPluginName()
    {
        if (!$this->name || !$this->slug) {
            throw new \InvalidArgumentException('Missing Plugin name or slug.');
        }
    }

    /**
     * Returns the view namespace in a camel case format based off
     * the plugins class name, with plugin stripped off the end.
     *
     * Eg: ArticlesPlugin will be accessible through 'plugin:articles::<view name>'
     *
     * @return string
     */
    protected function getViewNamespace()
    {
        $viewNameSpace = 'plugin:' . camel_case(
            mb_substr(
                get_called_class(),
                strrpos(get_called_class(), '\\') + 1,
                -6
            )
        );

        $this->view_namespace = $viewNameSpace.'::';

        return $viewNameSpace;

    }

    /**
     * Add a view namespace for this plugin.
     * Eg: view("plugin:articles::{view_name}")
     *
     * @param string $path
     */
    protected function enableViews($path = 'views')
    {
        $this->app['view']->addNamespace(
            $this->getViewNamespace(),
            $this->getPluginPath() . DIRECTORY_SEPARATOR . $path
        );
    }

    /**
     * Enable routes for this plugin.
     *
     * @param string $path
     */
    protected function enableRoutes($path = 'routes.php'){
        $this->app->router->group(['middleware' => 'web', 'namespace' => $this->getPluginControllerNamespace()], function ($app) use ($path) {
            require $this->getPluginPath() . DIRECTORY_SEPARATOR . $path;
        });
    }

    /**
     * Register a database migration path for this plugin.
     *
     * @param  array|string  $paths
     * @return void
     */
    protected function enableMigrations($paths = 'migrations')
    {
        $this->app->afterResolving('migrator', function ($migrator) use ($paths) {
            foreach ((array) $paths as $path) {
                $migrator->path($this->getPluginPath() . DIRECTORY_SEPARATOR . $path);
            }
        });
    }

    /**
     * @return string
     */
    public function getPluginPath()
    {
        $reflector = $this->getReflector();
        $fileName  = $reflector->getFileName();

        return dirname($fileName);
    }

    /**
     * @return string
     */
    protected function getPluginControllerNamespace()
    {
        $reflector = $this->getReflector();
        $baseDir   = str_replace($reflector->getShortName(), '', $reflector->getName());

        return $baseDir . 'Http\\Controllers';
    }

    /**
     * @return \ReflectionClass
     */
    private function getReflector()
    {
        if (is_null($this->reflector)) {
            $this->reflector = new \ReflectionClass($this);
        }

        return $this->reflector;
    }

    /**
     * Returns a plugin view
     *
     * @param $view
     * @return \Illuminate\View\View
     */
    protected function view($view)
    {
        return view($this->getViewNamespace() . '::' . $view);
    }
}
