<?php

namespace App\Providers;

use Blade;
use Sentinel;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeCustomDirectives();
        $this->bootMenuViewComposer();
        $this->bootSkinComposer();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap our blade custom directives.
     *
     * @return void
     */
    private function bootBladeCustomDirectives()
    {
        Blade::directive('hasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php if (General::hasAccess{$expression}): ?>";
            }

            return;
        });

        Blade::directive('endhasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php endif; ?>";
            }

            return;
        });
    }

    /**
     * Bootstrap our menus.
     *
     * @return void
     */
    private function bootMenuViewComposer()
    {
        view()->composer('layout.backend.admin.master.master', function ($view) {
            $index = 0;
            $menus = Menu::where('parent', null)->orderBy('id', 'ASC')->get()->toArray();

            foreach ($menus as $menu) {
                if ((bool) $menu['is_parent']) {
                    if ($child = Menu::where('parent', $menu['id'])->get()->toArray()) {
                        foreach ($child as $value) {
                            $menus[$index]['child'][] = $value;
                            $menus[$index]['child_permissions'][] = $value['name'];
                        }
                    }
                }

                $index++;
            }
            $view->withMenus($menus);
        });
    }

    /**
     * Bootstrap user's layout skin.
     *
     * @return void
     */
    private function bootSkinComposer()
    {
        view()->composer('layout.backend.admin.master.master', function ($view) {
            $view->withSkin(user_info('skin'));
        });
    }
}
