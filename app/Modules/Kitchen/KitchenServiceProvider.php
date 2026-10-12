<?php

namespace App\Modules\Kitchen;

use App\Modules\ModuleServiceProvider;

final class KitchenServiceProvider extends ModuleServiceProvider
{
    public function register(): void {}

    protected function moduleAlias(): string
    {
        return 'kitchen';
    }
}
