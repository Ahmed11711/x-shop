<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturePackageSeeder extends Seeder
{
    public function run(): void
    {
        $connection = DB::connection('xshop_central');

        // 1. Features
        $features = [
            ['id' => 1,  'title' => 'Users Count',              'key' => 'max_users'],
            ['id' => 2,  'title' => 'Branches Count',           'key' => 'max_branches'],
            ['id' => 3,  'title' => 'Storage Space (GB)',        'key' => 'storage_limit'],
            ['id' => 4,  'title' => 'Products Count',           'key' => 'max_products'],
            ['id' => 5,  'title' => 'Sell Module',              'key' => 'module_sell'],
            ['id' => 6,  'title' => 'Purchases Module',         'key' => 'module_purchases'],
            ['id' => 7,  'title' => 'POS Module',               'key' => 'module_pos'],
            ['id' => 8,  'title' => 'Stock Transfers',          'key' => 'module_stock_transfers'],
            ['id' => 9,  'title' => 'Stock Adjustment',         'key' => 'module_stock_adjustment'],
            ['id' => 10, 'title' => 'Expenses Module',          'key' => 'module_expenses'],
            ['id' => 11, 'title' => 'Reports Module',           'key' => 'module_reports'],
            ['id' => 12, 'title' => 'Woocommerce Integration',  'key' => 'module_woocommerce'],
            ['id' => 13, 'title' => 'Notification Templates',   'key' => 'module_notifications'],
            ['id' => 14, 'title' => 'Custom Domain',            'key' => 'custom_domain'],
            ['id' => 15, 'title' => 'Technical Support 24/7',   'key' => 'support_24_7'],
        ];

        foreach ($features as $feature) {
            $connection->table('features')->updateOrInsert(
                ['id' => $feature['id']],
                array_merge($feature, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }

        // 2. Packages
        $packages = [
            [
                'id'               => 1,
                'title'            => 'Trial Package',
                'desc'             => 'جرب النظام مجاناً لمدة أسبوع',
                'price'            => 0,
                'duration_months'  => 0.25,
                'recommended'      => false,
                'features' => [
                    ['feature_id' => 1,  'value' => '2',     'label' => '2 Users Only'],
                    ['feature_id' => 2,  'value' => '1',     'label' => '1 Branch Only'],
                    ['feature_id' => 3,  'value' => '2',     'label' => '2 GB Storage'],
                    ['feature_id' => 4,  'value' => '50',    'label' => '50 Products Only'],
                    ['feature_id' => 5,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 6,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 7,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 8,  'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 9,  'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 10, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 11, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 12, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 13, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 14, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 15, 'value' => '0',     'label' => 'Not Supported'],
                ],
            ],
            [
                'id'               => 2,
                'title'            => 'Basic Package',
                'desc'             => 'مناسب للشركات الصغيرة',
                'price'            => 500,
                'duration_months'  => 1,
                'recommended'      => false,
                'features' => [
                    ['feature_id' => 1,  'value' => '5',     'label' => '5 Users'],
                    ['feature_id' => 2,  'value' => '1',     'label' => '1 Branch'],
                    ['feature_id' => 3,  'value' => '10',    'label' => '10 GB Storage'],
                    ['feature_id' => 4,  'value' => '500',   'label' => '500 Products'],
                    ['feature_id' => 5,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 6,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 7,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 8,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 9,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 10, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 11, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 12, 'value' => '0',     'label' => 'Not Supported'],
                    ['feature_id' => 13, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 14, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 15, 'value' => '0',     'label' => 'Not Supported'],
                ],
            ],
            [
                'id'               => 3,
                'title'            => 'Professional Package',
                'desc'             => 'الأكثر شيوعاً للشركات المتوسطة',
                'price'            => 1500,
                'duration_months'  => 3,
                'recommended'      => true,
                'features' => [
                    ['feature_id' => 1,  'value' => '20',    'label' => '20 Users'],
                    ['feature_id' => 2,  'value' => '5',     'label' => '5 Branches'],
                    ['feature_id' => 3,  'value' => '100',   'label' => '100 GB Storage'],
                    ['feature_id' => 4,  'value' => '-1',    'label' => 'Unlimited Products'],
                    ['feature_id' => 5,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 6,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 7,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 8,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 9,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 10, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 11, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 12, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 13, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 14, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 15, 'value' => '1',     'label' => 'Live Support'],
                ],
            ],
            [
                'id'               => 4,
                'title'            => 'Enterprise Package',
                'desc'             => 'تحكم كامل للشركات الكبيرة',
                'price'            => 5000,
                'duration_months'  => 12,
                'recommended'      => false,
                'features' => [
                    ['feature_id' => 1,  'value' => '-1',    'label' => 'Unlimited Users'],
                    ['feature_id' => 2,  'value' => '-1',    'label' => 'Unlimited Branches'],
                    ['feature_id' => 3,  'value' => '1024',  'label' => '1 TB Storage'],
                    ['feature_id' => 4,  'value' => '-1',    'label' => 'Unlimited Products'],
                    ['feature_id' => 5,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 6,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 7,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 8,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 9,  'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 10, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 11, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 12, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 13, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 14, 'value' => '1',     'label' => 'Available'],
                    ['feature_id' => 15, 'value' => '1',     'label' => 'VIP Support'],
                ],
            ],
        ];

        // 3. Sync
        foreach ($packages as $pkgData) {
            $featureSet = $pkgData['features'];
            unset($pkgData['features']);

            $connection->table('packages')->updateOrInsert(
                ['id' => $pkgData['id']],
                array_merge($pkgData, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );

            foreach ($featureSet as $f) {
                $featureKey = $connection->table('features')
                    ->where('id', $f['feature_id'])
                    ->value('key');

                $connection->table('feature_packages')->updateOrInsert(
                    [
                        'package_id' => $pkgData['id'],
                        'feature_id' => $f['feature_id'],
                    ],
                    [
                        'value'       => $f['value'],
                        'lable' => $f['label'],
                        'key_feature' => $featureKey,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]
                );
            }
        }
    }
}
