<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class FarmMenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'farm')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Mining Farm',
            'url'     => '',
            'route'   => 'site.farm',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'order'      => 15,
                'parameters' => '{"farm":1}',
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Data Center',
            'url'     => '',
            'route'   => 'site.farm',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'order'      => 16,
                'parameters' => '{"farm":2}',
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Denmark DC',
            'url'     => '',
            'route'   => 'site.farm',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'order'      => 17,
                'parameters' => '{"farm":3}',
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Gouda',
            'url'     => '',
            'route'   => 'site.farm',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'order'      => 18,
                'parameters' => '{"farm":4}',
            ])->save();
        }
    }
}
