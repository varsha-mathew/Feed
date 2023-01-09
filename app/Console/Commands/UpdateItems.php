<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateItems extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the items from the JSON feed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // fetch the data from the JSON feed
        $response = Http::get('https://dev.shepherd.appoly.io/fruit.json');
        $data = $response->json();

        // loop through the data and update the database
        foreach ($data['menu_items'] as $item) {
            $dbItem = Item::where('item', $item['item'])->first();
            if (!$dbItem) {
                // item does not exist in the database, create a new one
                $dbItem = new Item;
                $dbItem->name = $item['label'];
            }
            if (isset($item['children'])) {
                // item has children, update them as well
                $dbItem->children()->delete();
                foreach ($item['children'] as $child) {
                    $dbChild = new Item;
                    $dbChild->name = $child['label'];
                    $dbItem->children()->save($dbChild);
                }
            }
            $dbItem->save();
        }
    }


}
