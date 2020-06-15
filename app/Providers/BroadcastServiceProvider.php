<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
  // @codeCoverageIgnoreStart
    public function boot()
  // @codeCoverageIgnoreEnd
    {
        Broadcast::routes();
      // @codeCoverageIgnoreStart
        require base_path('routes/channels.php');
      // @codeCoverageIgnoreEnd
    }

}
