<?php
/**
 * @desc permission.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/11/11 20:20
 */
return [
    'default' => 'basic',
    'enforcers' => [
        'basic' => [
            # Model 设置
            'model' => [
                'config_type' => 'file',
                'config_file_path' => config_path() . '/rbac-resource-model.conf',
                'config_text' => '',
            ],
            # 适配器
            'adapter' => \Tinywan\Casbin\model\DatabaseAdapter::class,
            'database' => [
                'connection' => '',
                'rules_table' => 'sys_casbin_rule',
            ],
            # 多进程策略定时刷新时间，单位秒
            'policy_refresh_time_interval' => 180
        ],
    ]
];