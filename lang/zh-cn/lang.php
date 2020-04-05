<?php 

return [
    'plugin' => [
        'name' => '用户',
        'description' => '用户管理.',
        'tab' => '用户',
        'access_users' => '管理用戶',
        'access_groups' => '管理用户组',
        'access_settings' => '管理用户设置',
        'impersonate_user' => '模拟用户'
    ],
    'users' => [
        'menu_label' => '用户',
        'all_users' => '所有用户',
        'new_user' => '添加新用户',
        'list_title' => '管理用户',
        'trashed_hint_title' => '用户已停用其帐户',
        'trashed_hint_desc' => '此用户已停用其帐户，不再希望出现在网站上。他们可以在任何时候通过重新登录来恢复帐户。',
        'banned_hint_title' => '用户已被禁止',
        'banned_hint_desc' => '该用户已被管理员禁止，无法登录。',
        'guest_hint_title' => '这是一个游客用户',
        'guest_hint_desc' => '此用户仅供参考，在登录前需要注册。',
        'activate_warning_title' => '用户未激活!',
        'activate_warning_desc' => '用户未激活,无法登录.',
        'activate_confirm' => '确认激活该用户?',
        'activated_success' => '用户激活成功!',
        'activate_manually' => '手动激活该用户',
        'convert_guest_confirm' => '转换访客为用户吗？',
        'convert_guest_manually' => '转换为注册用户',
        'convert_guest_success' => '用户已转换为注册帐户',
        'impersonate_user' => '模拟用户',
        'impersonate_confirm' => '模拟此用户？您可以通过注销恢复到原始状态。',
        'impersonate_success' => '您现在正在模拟该用户',
        'delete_confirm' => '确认删除该用户?',
        'unban_user' => '解禁用户',
        'unban_confirm' => '确定解禁该用户吗？',
        'unbanned_success' => '用户已经解禁',
        'return_to_list' => '返回用户列表',
        'update_details' => '更新详细信息',
        'bulk_actions' => '批量操作',
        'delete_selected' => '删除选中',
        'delete_selected_confirm' => '删除所选用户?',
        'delete_selected_empty' => '未选择任何用户.',
        'delete_selected_success' => '成功删除所选用户.',
        'activate_selected' => '激活选中的',
        'activate_selected_confirm' => '激活所选用户？',
        'activate_selected_empty' => '没有要激活的选中用户。',
        'activate_selected_success' => '已成功激活所选用户。',
        'deactivate_selected' => '停用选中',
        'deactivate_selected_confirm' => '确定停用选中的用户吗？',
        'deactivate_selected_empty' => '没有选中任何要停用的用户。',
        'deactivate_selected_success' => '成功停用选定的用户。',
        'restore_selected' => '恢复选中',
        'restore_selected_confirm' => '确定恢复选中的用户吗？',
        'restore_selected_empty' => '没有选中任何要恢复的用户。',
        'restore_selected_success' => '成功恢复选中选中的用户。',
        'ban_selected' => '禁用选中',
        'ban_selected_confirm' => '确定禁止选中的用户吗？',
        'ban_selected_empty' => '没有选中的用户需要禁用。',
        'ban_selected_success' => '成功禁用选中用户',
        'unban_selected' => '启用选中',
        'unban_selected_confirm' => '确定启用选中的用户吗?',
        'unban_selected_empty' => '没有选中的用户可以启用。',
        'unban_selected_success' => '成功启用选中的用户。',
    ],
    'settings' => [
        'users' => '用户',
        'menu_label' => '用户选项',
        'menu_description' => '管理用户选项.',
        'activation_tab' => '激活',
        'signin_tab' => '登录',
        'registration_tab' => '注册',
        'profile_tab' => 'Profile',
        'notifications_tab' => '提醒',
        'allow_registration' => '允许用户注册',
        'allow_registration_comment' => '如果禁用注册，用户只能由管理员创建。',
        'activate_mode' => '激活模式',
        'activate_mode_comment' => '选择激活方式.',
        'activate_mode_auto' => '自动',
        'activate_mode_auto_comment' => '注册成功后自动激活.',
        'activate_mode_user' => '用户',
        'activate_mode_user_comment' => '邮件激活、手机注册自动激活.',
        'activate_mode_admin' => '管理员',
        'activate_mode_admin_comment' => '管理员激活.',
        'require_activation' => '登录必须激活',
        'require_activation_comment' => '用户必须激活后才能登录.',
        'use_throttle' => '登录限制',
        'use_throttle_comment' => '用户重复登录失败时禁用用户.',
        'use_register_throttle' => '注册节流',
        'use_register_throttle_comment' => '防止在短时间内从同一个IP进行多次注册。',
        'block_persistence' => '阻止并发会话',
        'block_persistence_comment' => '启用后，用户不能同时登录多个设备。',
        'login_attribute' => '登录字段',
        'login_attribute_comment' => '选择用户登录类型.',
        'remember_login' => '记住登录状态',
        'remember_login_comment' => '用户登录后会话是否长期有效。',
        'remember_always' => '总是',
        'remember_never' => '从不',
        'remember_ask' => '登录时询问用户',
    ],
    'user' => [
        'label' => '用户',
        'id' => 'ID',
        'username' => '用户名',
        'name' => '名',
        'name_empty' => '匿名的',
        'surname' => '姓',
        'email' => '邮箱',
        'created_at' => '注册时间',
        'last_seen' => '最近访问',
        'is_guest' => '访客',
        'joined' => '加入',
        'is_online' => '当前在线',
        'is_offline' => '当前离线',
        'send_invite' => '用邮件发送邀请',
        'send_invite_comment' => '发送一个包含用户名和密码的欢迎消息',
        'create_password' => '创建密码',
        'create_password_comment' => '输入登陆新密码',
        'reset_password' => '重置密码',
        'reset_password_comment' => '请输入新密码.',
        'confirm_password' => '确认密码',
        'confirm_password_comment' => '再次输入密码.',
        'groups' => '群组',
        'empty_groups' => '无可用用户群组',
        'avatar' => '头像',
        'details' => '描述',
        'account' => '帐号',
        'block_mail' => '阻止向该用户发送邮件',
        'status_guest' => '访客',
        'status_activated' => '激活的',
        'status_registered' => '已注册的',
        'created_ip_address' => '创建时IP地址',
        'last_ip_address' => '最近访问IP地址',
    ],
    'group' => [
        'label' => '群组',
        'id' => 'ID',
        'name' => '姓名',
        'description_field' => '描述',
        'code' => '编码',
        'code_comment' => '输入一个唯一编码来标记当前用户组',
        'created_at' => '创建',
        'users_count' => '用户',
    ],
    'groups' => [
        'menu_label' => '群组',
        'all_groups' => '用户群组',
        'new_group' => '新的用户组',
        'delete_selected_confirm' => '确定清空选中用户组么？',
        'list_title' => '管理群组',
        'delete_confirm' => '确定要删除该群组吗？',
        'delete_selected_success' => '成功删除选中的群组。',
        'delete_selected_empty' => '没有选中的要删除的群组。',
        'return_to_list' => '返回群组列表',
        'return_to_users' => '返回用户列表',
        'create_title' => '创建群组',
        'update_title' => '编辑群组',
        'preview_title' => '上一个群组',
    ],
    'login' => [
        'attribute_email' => '邮箱',
        'attribute_username' => '用户名',
    ],
    'account' => [
        'account' => '帐号',
        'account_desc' => '用户信息.',
        'banned' => '抱歉，此用户当前未激活。请联系我们寻求进一步的帮助',
        'redirect_to' => '跳转至',
        'redirect_to_desc' => '登录或注册成功后跳转页面.',
        'code_param' => '激活码参数。',
        'code_param_desc' => '激活码的验证页面URL参数',
        'force_secure' => '强制安全协议',
        'force_secure_desc' => '始终使用HTTPS模式重定向该网址。',
        'invalid_user' => '未找到该用户。',
        'invalid_activation_code' => '错误的激活码',
        'invalid_deactivation_pass' => '密码不正确。',
        'invalid_current_pass' => '您输入的当前密码无效。',
        'success_activation' => '您的帐号已成功激活.',
        'success_deactivation' => '成功停用您的账号，很抱歉看到您离我而去!',
        'success_saved' => '设置保存成功!',
        'login_first' => '您需要先登录帐号才能访问该页面!',
        'already_active' => '您的帐号暂未激活!',
        'activation_email_sent' => '激活邮件已发送至您的邮箱.',
        'registration_disabled' => '当前已经禁用注册。',
        'registration_throttled' => '注册被限制，请稍后再试。',
        'sign_in' => '登录',
        'register' => '注册',
        'full_name' => '全名',
        'email' => '邮箱',
        'password' => '密码',
        'login' => '登录',
        'new_password' => '设置密码',
        'new_password_confirm' => '确认密码',
        'update_requires_password' => '更新时确认密码',
        'update_requires_password_comment' => '更改用户信息时需要用户的当前密码'
    ],
    'reset_password' => [
        'reset_password' => '重置密码',
        'reset_password_desc' => '找回密码.',
        'code_param' => '重置验证码参数',
        'code_param_desc' => '重置密码的验证码页面URL参数',
    ],
    'session' => [
        'session' => '会话',
        'session_desc' => '将用户会话添加到页面，可以限制页访问。',
        'security_title' => '仅允许',
        'security_desc' => '谁可以访问这个页面。',
        'all' => '所有人',
        'users' => '注册用户',
        'guests' => '游客',
        'allowed_groups_title' => '允许群组',
        'allowed_groups_description' => '选择“允许的群组”或“无”以允许所有群组',
        'redirect_title' => '跳转至',
        'redirect_desc' => '拒绝访问时重定向到页面的名字。',
        'logout' => '你已经成功退出登陆！',
        'stop_impersonate_success' => '您不再模拟用户。',
    ]
];
