Yii2 Treeview
=============
🟥⚠️ _THIS PACKAGE IS ABANDONED. PLEASE SELECT ANOTHER PACKAGE OR FORK THIS REPOSITRY AND INFORM ME ON p.g.meysam [at] gmail [dot] com TO REFFER TO YOUR PACKAGE IN PACKAGIST_ ⚠️🟥

A Bootstrap Treeview Generator for AdminLte Sidebar

Description
-----------

It's just an extended version of `yii\bootstrap\Nav` for generating proper code for sidebar of [AdminLte](https://almsaeedstudio.com/themes/AdminLTE/index.html) with support of badgets.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require meysampg/yii2-treeview "*"
```

or add

```
"meysampg/yii2-treeview": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by:

```php
use meysampg\treeview\Treeview;
```
and use it on your code by 
```php
<!-- sidebar menu: : style can be found in sidebar.less -->
<?= Treeview::widget([
    'items' => [
      [
          'label' => Yii::t('app', 'Dashboard'),
          'icon' => 'fa fa-dashboard',
          'url' => Url::home(),
      ],
      [
          'label' => Yii::t('app', 'Messages'),
          'icon' => 'fa fa-envelope',
          'items' => [
              [
                  'label' => Yii::t('app', 'Inbox'),
                  'url' => ['/message/inbox'],
              ],
              [
                  'label' => Yii::t('app', 'Outbox'),
                  'url' => ['/message/outbox'],
              ],
              [
                  'label' => Yii::t('app', 'Create'),
                  'url' => ['/message/create'],
              ],
          ],
      ],
    ]
]) ?>
```
And simply output is what is needed:

![dashboard_lte](https://cloud.githubusercontent.com/assets/1416085/19635955/f48c749c-99d2-11e6-9a9d-0ac5ff911684.png)


Examples
-------------

H‍‍‍ere is a RTL example:
```php
<!-- sidebar menu: : style can be found in sidebar.less -->
<?= Treeview::widget([
    'items' => [
        [
            'label' => 'داشبورد',
            'icon' => 'fa fa-dashboard',
            'url' => Url::home(),
        ],
        [
            'label' => 'پیام‌ها',
            'icon' => 'fa fa-envelope',
            'items' => [
                [
                    'label' => 'صندوق ورودی',
                    'url' => ['/message/inbox'],
                    'badget' => [
                        'text' => 4,
                        'color' => 'label-info',
                        'float' => 'left',
                    ],
                ],
                [
                    'label' => 'صندوق خروجی',
                    'url' => ['/message/outbox'],
                ],
                [
                    'label' => 'ایجاد پیام',
                    'url' => ['/message/create'],
                ],
            ],
        ],
    ]
]) ?>
```

![dashboard_lte_rtl](https://cloud.githubusercontent.com/assets/1416085/19637415/cfae359e-99db-11e6-8db4-78870419d6cd.png)

and a LTR example:
```php
<!-- sidebar menu: : style can be found in sidebar.less -->
<?= Treeview::widget([
    'items' => [
        [
            'label' => 'Dashboard',
            'icon' => 'fa fa-dashboard',
            'url' => Url::home(),
        ],
        [
            'label' => 'Message',
            'icon' => 'fa fa-envelope',
            'items' => [
                [
                    'label' => 'Inbox',
                    'url' => ['/message/inbox'],
                    'badget' => [
                        'text' => 4,
                        'color' => 'label-info',
                    ],
                ],
                [
                    'label' => 'Outbox',
                    'url' => ['/message/outbox'],
                ],
                [
                    'label' => 'Create',
                    'url' => ['/message/create'],
                ],
            ],
        ],
    ]
]) ?>
```
![dashboard_lte_ltr](https://cloud.githubusercontent.com/assets/1416085/19637413/cf6636cc-99db-11e6-90ab-4c0ed6cf91b1.png)

Configuration
------------------
There is no much configuration for this extension. Just it's needed to send an array of sidebar items to `items` property of `Treeview`. Also for `color` property of `badget` It can be a CSS class with color, for continence you can  use this values:

 - `label-default`
 - `label-success`
 - `label-info`
 - `label-danger`
 - `label-warning`

Contribution
----------------

Report bugs, request a feature or do your modification and send a pull request :).
