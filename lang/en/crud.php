<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'all_collections' => [
        'name' => 'All Collections',
        'index_title' => 'AllCollections List',
        'new_title' => 'New Collections',
        'create_title' => 'Create Collections',
        'edit_title' => 'Edit Collections',
        'show_title' => 'Show Collections',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'all_rentals' => [
        'name' => 'All Rentals',
        'index_title' => 'AllRentals List',
        'new_title' => 'New Rentals',
        'create_title' => 'Create Rentals',
        'edit_title' => 'Edit Rentals',
        'show_title' => 'Show Rentals',
        'inputs' => [
            'user_id' => 'User',
            'video_id' => 'Video',
            'type' => 'Type',
            'total_value' => 'Total Value',
            'view_limit' => 'View Limit',
        ],
    ],

    'all_series' => [
        'name' => 'All Series',
        'index_title' => 'AllSeries List',
        'new_title' => 'New Series',
        'create_title' => 'Create Series',
        'edit_title' => 'Edit Series',
        'show_title' => 'Show Series',
        'inputs' => [
            'name' => 'Name',
            'main_person_id' => 'People',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'points' => 'Points',
            'referrer_id' => 'User',
        ],
    ],

    'videos' => [
        'name' => 'Videos',
        'index_title' => 'Videos List',
        'new_title' => 'New Video',
        'create_title' => 'Create Video',
        'edit_title' => 'Edit Video',
        'show_title' => 'Show Video',
        'inputs' => [
            'title' => 'Title',
            'attributes' => 'Attributes',
            'original_language' => 'Original Language',
            'classification' => 'Classification',
            'series_id' => 'Series',
        ],
    ],

    'video_video_people' => [
        'name' => 'Video Video People',
        'index_title' => 'VideoPeople List',
        'new_title' => 'New Video person',
        'create_title' => 'Create VideoPerson',
        'edit_title' => 'Edit VideoPerson',
        'show_title' => 'Show VideoPerson',
        'inputs' => [
            'people_id' => 'People',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
