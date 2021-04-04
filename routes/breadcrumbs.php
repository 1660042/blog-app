<?php
Breadcrumbs::for('backend.index', function ($trail) {
    $trail->push('Trang chủ', route('backend.index'));
});

//Categories
Breadcrumbs::for('backend.posts.categories.index', function ($trail) {
    $trail->parent('backend.index');
    $trail->push('Chuyên mục', route('backend.posts.categories.index'));
});

Breadcrumbs::for('backend.posts.categories.create', function ($trail) {
    $trail->parent('backend.posts.categories.index');
    $trail->push('Tạo mới', route('backend.posts.categories.create'));
});

Breadcrumbs::for('backend.posts.categories.edit', function ($trail) {
    $trail->parent('backend.posts.categories.index');
    $trail->push('Cập nhật', route('backend.posts.categories.edit', 1));
});

//Posts
Breadcrumbs::for('backend.posts.posts.index', function ($trail) {
    $trail->parent('backend.index');
    $trail->push('Bài viết', route('backend.posts.posts.index'));
});

Breadcrumbs::for('backend.posts.posts.create', function ($trail) {
    $trail->parent('backend.posts.posts.index');
    $trail->push('Tạo mới', route('backend.posts.posts.create'));
});

Breadcrumbs::for('backend.posts.posts.edit', function ($trail) {
    $trail->parent('backend.posts.posts.index');
    $trail->push('Cập nhật', route('backend.posts.posts.edit', 1));
});

//Accounts
Breadcrumbs::for('backend.accounts.accounts.index', function ($trail) {
    $trail->parent('backend.index');
    $trail->push('Tài khoản', route('backend.accounts.accounts.index'));
});

Breadcrumbs::for('backend.accounts.accounts.create', function ($trail) {
    $trail->parent('backend.accounts.accounts.index');
    $trail->push('Tạo mới', route('backend.accounts.accounts.create'));
});

Breadcrumbs::for('backend.accounts.accounts.edit', function ($trail) {
    $trail->parent('backend.accounts.accounts.index');
    $trail->push('Cập nhật', route('backend.accounts.accounts.edit', 1));
});

//Roles
Breadcrumbs::for('backend.systems.roles.index', function ($trail) {
    $trail->parent('backend.index');
    $trail->push('Quyền', route('backend.systems.roles.index'));
});

Breadcrumbs::for('backend.systems.roles.create', function ($trail) {
    $trail->parent('backend.systems.roles.index');
    $trail->push('Tạo mới', route('backend.systems.roles.create'));
});

Breadcrumbs::for('backend.systems.roles.edit', function ($trail) {
    $trail->parent('backend.systems.roles.index');
    $trail->push('Cập nhật', route('backend.systems.roles.edit', 1));
});
