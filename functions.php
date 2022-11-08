<?php
add_role('OA_Editor', __(
   'OA Editor'),
   array(

                    'manage_categories' => true,
                    'manage_links' => true,
                    'upload_files' => true,
                    'unfiltered_html' => true,
                    'edit_posts' => true,
                    'edit_others_posts' => true,
                    'edit_published_posts' => true,
                    'publish_posts' => false,
                    'edit_pages' => true,
                    'read' => true,
                    'edit_others_pages' => true,
                    'edit_published_pages' => true,
                    'publish_pages' => false,
                    'delete_pages' => true,
                    'delete_others_pages' => false,
                    'delete_published_pages' => false,
                    'delete_posts' => true,
                    'delete_others_posts' => false,
                    'delete_published_posts' => true,
                    'delete_private_posts' => true,
                    'edit_private_posts' => true,
                    'read_private_posts' => true,
                    'delete_private_pages' => true,
                    'edit_private_pages' => true,
                    'read_private_pages' => true,
       )
);
?>
