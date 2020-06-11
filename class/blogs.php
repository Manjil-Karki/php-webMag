<?php
    class blogs extends database{
        function __construct(){
            $this->table = 'blogs';
            database :: __construct();
        }
        public function addBlog($data, $is_die = false){
            return $this->addData($data, $is_die);
        }
    public function getBlogById($blog_id, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date',
                        'added_by'],
            'where' => array(
                'or' => array(
                    'id' => $blog_id,
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function getAllBlogsByCreatedDate($date, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => " where created_date LIKE '".$date."%'"
        );
        return $this->getData($args, $is_die);
    }

    public function getAllBlogs($is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image'],
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )                
            )
        );
        return $this->getData($args, $is_die);
    }


    public function getAllBlogsByCategory($cat_id, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title'
                        ],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'categoryid'=> $cat_id
                )                
            )
        );
        return $this->getData($args, $is_die);
    }


    public function getMostRecentBlogsWithLimit($offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active'
                )            
            ),
            'order' => array(
                'columnname' => 'created_date',
                'orderType' => 'DESC'
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )    
        );
        return $this->getData($args, $is_die);
    }

    public function getMostReadBlogsWithLimit($offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'or' => array(
                    'status' => 'Active'
                )            
            ),
            'order' => array(
                'columnname' => 'view',
                'orderType' => 'DESC'
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )    
        );
        return $this->getData($args, $is_die);
    }

    public function getMostReadFeaturedBlogsWithLimit($offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'featured' => 'Featured'
                )            
            ),
            'order' => array(
                'columnname' => 'view',
                'orderType' => 'DESC'
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )    
        );
        return $this->getData($args, $is_die);
    }

    public function getAllFeaturedBlogsWithLimit($offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'featured' => 'Featured'
                )                
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )

        );
        return $this->getData($args, $is_die);
    }


    public function getAllFeaturedBlogsByCategoryWithLimit($cat_id, $offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'featured' => 'Featured',
                    'categoryid' => $cat_id,
                )                
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )

        );
        return $this->getData($args, $is_die);
    }

    public function getAllRecentBlogsByCategoryWithLimit($cat_id, $offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'categoryid' => $cat_id
                )                
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )

        );
        return $this->getData($args, $is_die);
    }

    public function getAllPopulartBlogsByCategoryWithLimit($cat_id, $offset, $no_of_data, $is_die = false){
        $args = array(
            'fields' => ['id',
                        'title',
                        'content',
                        'featured',
                        'categoryid',
                        '(SELECT categoryname from categories where id = categoryid) as category',
                        'view',
                        'image',
                        'created_date'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'categoryid' => $cat_id
                )                
            ),
            'order' => array(
                'columnname' => 'view',
                'orderType' => 'DESC'
            ),
            'limit' => array(
                'offset' => $offset,
                'no_of_data' => $no_of_data
            )

        );
        return $this->getData($args, $is_die);
    }

    public function getNumberOfBlogsByCategory($cat_id, $is_die = false){
        $args = array(
            'fields' => ['COUNT(id) as total'],
            'where' => array(
                'and' => array(
                    'status' => 'Active',
                    'categoryid' => $cat_id
                )                
            )
        );
        return $this->getData($args, $is_die);
    }

    public function updateBlogById($data, $id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->updataData($data, $args, $is_die);
    }

    public function deleteBlogById($id, $is_die = false){
        $args = array(
            'where' => array(
                'or' => array(
                    'id' => $id,
                )                
            )
        );
        return $this->deleteData($args, $is_die);
    }

}


?>