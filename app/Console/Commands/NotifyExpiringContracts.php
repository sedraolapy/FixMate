<?php

    namespace App\Console\Commands;

    use App\Models\Admin;
    use App\Models\ServiceProvider;
    use App\Notifications\ServiceProviderContractExpiring;
    use Carbon\Carbon;
    use Illuminate\Console\Command;

    class NotifyExpiringContracts extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'notify:expiring-contracts';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Notify admin 28 days before service provider contract expires';

        /**
         * Execute the console command.
         */
        public function handle()
        {
            $targetDate = Carbon::now()->addDays(28)->toDateString();

            $providers = ServiceProvider::whereDate('end_date', $targetDate)->get();

            if ($providers->isEmpty()) {
                $this->info('No contracts expiring in 28 days.');
                return;
            }

            $admins = Admin::all(); // recipients

            foreach ($providers as $provider) {
                ServiceProviderContractExpiring::createForRecipients(
                    $provider->name,
                    $provider->end_date->format('Y-m-d'),
                    $admins
                );
            }

            $this->info('Notifications sent for contracts expiring in 28 days.');
        }
    }
